<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
include 'admin/helper/dbconnect.php';
include 'php_helper.php';



$name = $_POST['name'];
$email = $_POST['email'];
$type = $_POST['subject'];
$number = $_POST['number'];
$message = $_POST['message'];

$sql = "INSERT INTO `contact_form` (`name`, `email`, `subject`, `phone_number`, `message`) VALUES('$name', '$email', '$type', '$number', '$message')";
$result = mysqli_query($conn, $sql);

$sql = "SELECT * FROM mail_data WHERE mail_of ='HR'";
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
     <tr>
         <th>Subject:</th>
         <td> $_POST[subject]</td>
     </tr>
     <tr>
         <th>Number:</th>
         <td> $_POST[number]</td>
     </tr>
     <tr>
         <th>Message:</th>
         <td> $_POST[message]</td>
     </tr>
     </table>";

     $content = "<table width='100%' style='width:100%'>
     <tbody>
         <tr style='margin:0;padding:0'>
             <td style='margin:0;padding:30px 40px 20px 40px;background-color:#f5f5f6!important;width:calc(100% - (40px*2));border-radius:8px'
                 width='calc(100% - (40*2))'>
                 <table width='100%'>
                     <tbody>
                         <tr style='margin:0;padding:0'>
                             <td style='margin:0;padding:0'>
                                 <div>
                                     <div style='display:table;margin:20px 0;width:100%'>
                                         <div style='vertical-align:top;display:table-cell;width:100%;background-repeat:no-repeat;background-size:32px;background-position:right 16px top 16px;background-image:url();border:solid 0.5px rgba(190,147,71,0.11);border-radius:4px;background-color:#ffffff'>
                                             <div
                                                 style='margin:0;font-size:17px;line-height:23px;padding:20px 20px 20px 20px;color:#282c3f'>
                                                 <p
                                                     style='margin:0;padding:0;width:100%;color:#282c3f;font-size:25px;margin-bottom:16px;font-weight:normal;font-stretch:normal;font-style:normal;line-height:normal;letter-spacing:normal'>
                                                     Hello $_POST[name]</p>
                                                 <div
                                                     style='margin:0 0 0 0;padding:0 0 0 0;width:100%;font-size:16px;line-height:1.38;letter-spacing:0.29px;color:#7e818c;font-weight:normal;font-stretch:normal;font-style:normal'>
                                                     <span>Thank you for choosing us. We hope you had a glad experience!. 
                                                         We always strive to keep improving the service we offer.Our highest priority is to ensure that these service meet your experience.
                                                         Our HR is contact you as soos as possible!
                                                     </span>
                                                     <br><br><br>
                                                     <span>Thankyou for your time!
                                                     </span>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </td>
         </tr>
     </tbody>
 </table>";



$mail_status =  sendMail($reciever, "Contact form data", $body);
$recieving_mail =  sendMail($_POST['email'], "Contact form data", $content);

echo json_encode($mail_status);
