<?php
session_start();
include 'mailer.php';
include 'helper/dbconnect.php';
$response = [];

if (isset($_POST['isset_login_form'])) {

    $email = mysqli_real_escape_string($conn,  $_POST['email']);
    $password = mysqli_real_escape_string($conn,  $_POST['password']);
    $sql = "SELECT * FROM  users where `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    $otp = mt_rand(1111, 9999);
    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;
            $email = $row['email'];
            $id = $row['user_id'];

            // if two_fa_email enabled then send otp for 2fa authentication 
            if ($row['two_fa_email'] == 'YES') {
                if (send_mail($email, "Confirmation", $otp)) {
                    $response['status'] = true;
                    $response['message'] = 'Please verify your device';
                } else {
                    $response['status'] = false;
                    $response['message'] = 'unable to handle request.';
                }
            } else {
                $_SESSION['login_status'] = session_id();
                $_SESSION['login_user'] = $email;

                $response['status'] = true;
                $response['login'] = true;
                $response['message'] = 'Login successfull.';
                $response['redirect'] = 'index.php';
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'Incorrect username or password';
        }
    } else {
        $response['status'] = false;
        $response['message'] = 'User not found';
    }



    echo json_encode($response);
}


if (isset($_POST['login_with_otp'])) {
    $email = $_SESSION['email'];
    $otp = $_POST['otp'];

    $sql = "SELECT * FROM users WHERE email  = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $select = mysqli_fetch_assoc($result);
        $otpv =  $_SESSION['otp'];

        if ($otpv == $otp) {
            $_SESSION['login_status'] = session_id();
            $_SESSION['login_user'] = $email;
            $response['status'] = true;
            $response['login'] = true;
            $response['message'] = 'Login successfull.';
            $response['redirect'] = 'index.php';

            unset($_SESSION['otp']);
            unset($_SESSION['email']);
        } else {
            $response['status'] = false;
            $response['message'] = 'Failed to verify otp';
        }
    } else {
        $response['status'] = false;
        $response['message'] = 'User not found';
    }

    echo json_encode($response);
}


if (isset($_POST['otp_to_forgot'])) {

    $email = mysqli_real_escape_string($conn,  $_POST['email']);
    $sql = "SELECT * FROM  users where `user_id` = '122333'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    $otp = mt_rand(1111, 9999);
    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (($email) == $row['email']) {
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;
            $email = $row['email'];
            $id = $row['user_id'];
            if (send_mail($email, "Confirmation", $otp)) {
                $response['status'] = true;
                $response['message'] = 'you are ready to change password';
            } else {
                $response['status'] = false;
                $response['message'] = 'unable to handle request.';
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'Incorrect email';
        }
    } else {
        $response['status'] = false;
        $response['message'] = 'User not found';
    }



    echo json_encode($response);
}

if (isset($_POST['new_password'])) {

    $new_password = mysqli_real_escape_string($conn, $_POST['npassword']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $sql = "SELECT * FROM  users where `user_id` = '122333'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        if ($new_password == $confirm_password) {
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            $update_password = "UPDATE users SET password='$hash' where `user_id` = '122333'";
            $update_run = mysqli_query($conn, $update_password);
            if ($update_run) {
                $response['status'] = true;
                $response['message'] = 'Login successfull.';
                $response['redirect'] = 'login.php';
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'Password not match';
        }
    } else {
        $response['status'] = false;
        $response['message'] = 'Password not match';
    }

    echo json_encode($response);
}

if (isset($_POST['confirm_otp'])) {
    $email = $_SESSION['email'];
    $otp = $_POST['otp'];

    $sql = "SELECT * FROM users WHERE email  = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $select = mysqli_fetch_assoc($result);
        $otpv =  $_SESSION['otp'];

        if ($otpv == $otp) {
            $response['status'] = true;
            $response['message'] = 'Otp Verified.';
            unset($_SESSION['otp']);
        } else {

            $response['status'] = false;
            $response['message'] = 'Failed to verify otp';
        }
    } else {
        $response['status'] = false;
        $response['message'] = 'User not found';
    }

    echo json_encode($response);
}


