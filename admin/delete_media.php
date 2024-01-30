<?php include 'helper/dbconnect.php';

$media_id = $_GET['media_id'];
$sql = "DELETE FROM media_data WHERE id = {$media_id}";
if(mysqli_query($conn, $sql)){
    header("location: http://localhost:8080/projects/ecom/admin/showMedia.php");
}

mysqli_close($conn);

?>