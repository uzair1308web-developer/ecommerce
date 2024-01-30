<?php
session_start();
include('mailer.php');

if (isset($_SESSION['login_status']) && isset($_SESSION['login_user'])) {
  header("location: index.php");
}



$login = false;
$showError = false;
// if (isset($_POST['login'])) {
//   include 'helper/dbconnect.php';
//   $email = $_POST["email"];
//   $password = $_POST["password"];
//   $username = mysqli_real_escape_string($conn, $email);
//   $password = mysqli_real_escape_string($conn, $password);
//   $sql = "SELECT * FROM  users where `user_id` = '122333'";
//   $result = mysqli_query($conn, $sql);
//   $num = mysqli_num_rows($result);

//   // $random_id = rand(time(),10000000);
//   $otp = mt_rand(1111, 9999);
//   if ($num == 1) {
//     $row = mysqli_fetch_assoc($result);
//     if (($password) === $row['password']) {
//       // $login = true;
//       // $_SESSION['loggedin'] = true;
//       // $_SESSION['username'] = $username;
//       // header("location: welcome.php");
//       $_SESSION['otp'] = $otp;
//       $_SESSION['random_id'] = $row['unique_id'];
//       $email = $row['email'];
//       $id = $row['user_id'];
//       send_mail($email, "Confirmation", $otp);
//       header("location: otp_verify.php?id=" . $id);

//       // generate opt & store it into session 
//       // store any unique data of user into a session  
//       // send mail  
//       // redirect to otp verification page  

//     } else {
//       $showError = "Invalid Credential";
//     }
//   } else {
//     $showError = "User already Registered";
//   }
// }

// ?>

<!doctype html>
<html lang="en" class="minimal-theme">


<!-- Mirrored from codervent.com/skodash/demo/tabular-menu/ltr/form-layouts.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Oct 2023 07:22:22 GMT -->

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
  <!-- <link href="assets/css/style.css" rel="stylesheet" /> -->
  <link href="assets/css/custom.css" rel="stylesheet" />
  <link href="assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">

  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet" />


  <!--Theme Styles-->
  <link href="assets/css/dark-theme.css" rel="stylesheet" />
  <link href="assets/css/light-theme.css" rel="stylesheet" />
  <link href="assets/css/semi-dark.css" rel="stylesheet" />
  <link href="assets/css/header-colors.css" rel="stylesheet" />

  <title>Skodash - Bootstrap 5 Admin Template</title>
</head>

<body>

  <?php
  if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You are loged in .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> ' . $showError . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>




  <div class="container layout">
    <div class="card mt-4 form-box">

      <div class="card-body">
        <div class="border p-3 rounded">
          <div id="alert-box">

          </div>
          <div id="form-box">

            <h6 class="mb-0 text-uppercase">Login form</h6>
            <hr />
            <form onsubmit="formSubmit(event)" class="row g-3" id="login-form" method="post">
              <div class="col-12">
                <label class="form-label">Email ID</label>
                <input type="text" class="form-control" name="email" id="email">
              </div>
              <div class="col-12">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
              </div>
              
              <div class="col-12 text-end">
                <a href="javascript:void(0);" onclick="forgot_password();">Forgot Password?</a>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button type="submit" id="login-form-btn" class="btn btn-primary" name="login">
                    Sign in
                  </button>
                </div>
              </div>
            </form>

          </div>

        </div>
      </div>
    </div>
  </div>


  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
  <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
  <script src="assets/js/pace.min.js"></script>
  <!--app-->
  <script src="assets/js/app.js"></script>

  <script>
    // $(document).ready(function(){
    //   $("#login-form").submit(function(event){
    //     event.preventDefault()

    //      let loginForm = document.getElementById('login-form'); 
    //      let data = new FormData(loginForm)
    //      console.log(data);     

    //     // $.ajax({
    //     //   type: "post",
    //     //   url:
    //     // })
    //   })
    // })


    function formSubmit(event) {

      $('#login-form-btn').html(`<div class="spinner-border spinner-border-sm text-light" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>`)

      event.preventDefault()
      let loginForm = document.getElementById('login-form');
      let formData = new FormData(loginForm)
      formData.append('isset_login_form', '1')

      $.ajax({
        type: "post",
        url: "ajax.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {

          let data = JSON.parse(response)
          if (data['status']) {



            $('#alert-box').html(
              `
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  ${data['message']}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                `
            )

            if (data['login']) {
              window.location.href = data['redirect']
            } else {
              $('#form-box').html(

                `
                <h6 class="mb-0 text-uppercase">otp verification</h6>
                <br/>
                <form onsubmit="otp_verification(event)" id="otp-form" method="POST" class="row g-3">
                    <div class="col-12">
                      <input type="number" class="form-control" name="otp" placeholder="enter otp" autocomplete="off">
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="verify">Verify</button>
                      </div>
                    </div>
                </form>
            </div>
                `

              )
            }


          } else {
            $('#alert-box').html(
              `
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  ${data['message']}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                `
            )
          }

          $('#login-form-btn').html(`Sign in`)

        }
      });
    }

    function otp_verification(event) {
      event.preventDefault()
      let otpform = document.getElementById('otp-form');
      let otp = new FormData(otpform)
      otp.append('login_with_otp', 'true')

      $.ajax({
        type: "post",
        url: "ajax.php",
        data: otp,
        contentType: false,
        processData: false,
        success: function(response) {
          let data = JSON.parse(response);
          if (data['status']) {
            window.location.href = data['redirect']
          } else {
            $('#alert-box').html(
              `
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  ${data['message']}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                `
            )

          }
        }
      })
    }

    function forgot_password(event) {
      $('#form-box').html(`
          <h6 class="mb-0 text-uppercase">Forgot Password</h6>
              <br/>
              <form onsubmit="otp_verify(event)" id="otp-form" method="POST" class="row g-3">
                  <div class="col-12">
                    <input type="email" class="form-control" name="email" placeholder="enter your registered mail" autocomplete="off">
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" id="login-form-btn" class="btn btn-primary" name="verify">Send otp</button>
                    </div>
                  </div>
              </form> 
            `)

    }

    function otp_verify(event) {
      $('#login-form-btn').html(`<div class="spinner-border spinner-border-sm text-light" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>`)
      event.preventDefault()
      let otpform = document.getElementById('otp-form');
      let otp = new FormData(otpform)
      otp.append('otp_to_forgot', 'true')

      $.ajax({
        type: "post",
        url: "ajax.php",
        data: otp,
        contentType: false,
        processData: false,
        success: function(response) {

          console.log(response);
          let data = JSON.parse(response)

          if (data['status']) {
            $('#alert-box').html(
              `<div class="alert alert-success alert-dismissible fade show" role="alert">
              ${data['message']}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
                `
            )

            $('#form-box').html(

              `
              <h6 class="mb-0 text-uppercase">otp verification</h6>
              <br/>
              <form onsubmit="otp_new_password(event)" id="otp-form" method="POST" class="row g-3">
                  <div class="col-12">
                    <input type="number" class="form-control" name="otp" placeholder="enter otp" autocomplete="off">
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button type="submit" id="login-form-btn" class="btn btn-primary" name="verify">Verify</button>
                    </div>
                  </div>
              </form>
          </div>
              `

            )

          } else {
            $('#alert-box').html(
              `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${data['message']}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
            )
          }

          $('#login-form-btn').html(`Verify`)
        }
      });
    }

    function otp_new_password(event) {


      event.preventDefault()
      let loginForm = document.getElementById('otp-form');
      let formData = new FormData(loginForm)
      formData.append('confirm_otp', '1')

      $.ajax({
        type: "post",
        url: "ajax.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          let data = JSON.parse(response)
          console.log(data);
          if (data['status']) {
            $('#alert-box').html(
              `
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              ${data['message']}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>  
                `
            )

            $('#form-box').html(`<h6 class="mb-0 text-uppercase">Change Your Password</h6>
            <hr />
            <form onsubmit="resetPassword(event)" class="row g-3" id="change-password" method="post">
              <div class="col-12">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="npassword" id="password">
              </div>
              <div class="col-12">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" id="cpassword">
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button type="submit" id="login-form-btn" class="btn btn-primary" name="login">
                    Submit
                  </button>
                </div>
              </div>
            </form>`);
          } else {
            $('#alert-box').html(
              `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${data['message']}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`
            )
          }
        }
      })
    }

    function resetPassword(event) {
      event.preventDefault()
      let loginForm = document.getElementById('change-password');
      let formData = new FormData(loginForm)
      formData.append('new_password', '1')
      $.ajax({
        type: "post",
        url: "ajax.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          console.log(response)
          let data = JSON.parse(response)
          if (data['status']) {
            window.location.href = data['redirect']
          } else {
            $('#alert-box').html(
              `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${data['message']}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`)
          }

        }
      })

    }
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>