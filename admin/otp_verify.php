<?php
session_start();
include 'helper/dbConnect.php';


if(isset($_POST['verify'])){
    if(isset($_GET['id'])){

        $id = $_GET['id'];
        $otp = $_POST['otp'];
    
        $sql = "SELECT * FROM users WHERE user_id  = '$id'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $select = mysqli_fetch_assoc($result);
            $otpv =  $_SESSION['otp'];
    
            if($otpv != $otp){
                echo "Please provide correct otp";
            } else{
               unset( $_SESSION['otp']);  
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $uname;
                header("location:index.php");
            }
        }
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .otp-box{
            border: 1px solid black;
            padding: 10px;
            display: flex;
            background-color: #111;
        }
    </style>
  </head>
  <body>
    <div class="container container-wrapper">
        <h2>Verify Your Account</h2>
        <form action=""  method="POST">
            <!-- <div class="error-text">Error</div> -->
            <div class="otp-box">
                <input type="number" name="otp" placeholder="enter otp" autocomplete="off">
                <input type="submit" name="verify" value="Verify">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>