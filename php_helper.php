
<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions


function discount($price, $offer_price)
{
   $discount = (($price - $offer_price) / $price) * 100;
   return $discount;
}

function sendMail($receiver, $subject, $message)
{
   $mail = new PHPMailer(true);

   try {
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'uzairkhan7521@gmail.com';                     //SMTP username
      $mail->Password   = 'dtqcvmyazotwvbal';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('uzairkhan7521@gmail.com', 'Uzair');

      $mail->addAddress($receiver);     //Add a recipient

      //Content


      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    =  $message;


      if ($mail->send()) {
         return   ['status' => true, 'msg' => "Mail sent successfully"];
      } else {
         return   ['status' => false, 'msg' => "Failed to send mail"];
      }
   } catch (Exception $e) {
      return   ['status' => false, 'msg' => $e->getMessage()];
   }
}
  


function sendOrdermail($receiver, $subject, $message)
{
   
   $mail = new PHPMailer(true);

   try {
      //Server settings
      // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'uzairkhan7521@gmail.com';                     //SMTP username
      $mail->Password   = 'dtqcvmyazotwvbal';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('uzairkhan7521@gmail.com', 'Uzair');

      $mail->addAddress($receiver);     //Add a recipient

      //Content

      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    =  $message;


      if ($mail->send()) {
         return   ['status' => true, 'msg' => "Mail sent successfully"];
      } else {
         return   ['status' => false, 'msg' => "Failed to send mail"];
      }
   } catch (Exception $e) {
      return   ['status' => false, 'msg' => $e->getMessage()];
   }
}


