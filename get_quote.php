<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
include 'admin/helper/dbconnect.php';
include 'php_helper.php';

$name = $_POST['name'];
$email = $_POST['email'];

$sql = "INSERT INTO `contact_form` (`name`, `email` ) VALUES('$name', '$email')";
$result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM mail_data WHERE mail_of ='Get Quote'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $reciever = $row['mail'];
}

$body = "<table border='1px solid red' cellspacing='0' cellpadding='6px'>
     <tr>
         <th>Name:</th>
         <td> $_POST[name]</td>
     </tr>
     <tr>
         <th>Email:</th>
         <td> $_POST[email]</td>
     </tr>
     </table>";

$mail_status =  sendMail($reciever, "Get quote", $body);

echo json_encode($mail_status);
