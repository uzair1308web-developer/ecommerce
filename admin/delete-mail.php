<?php include 'helper/dbconnect.php';

$mail_id = $_GET['mail_id'];
$sql = "DELETE FROM mail_data WHERE id = {$mail_id}";
if(mysqli_query($conn, $sql)){
    header("location: http://localhost:8080/projects/ecom/admin/showEmail.php");
}

mysqli_close($conn);

?>