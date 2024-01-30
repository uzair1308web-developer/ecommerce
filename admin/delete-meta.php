<?php include 'helper/dbconnect.php';

$meta_id = $_GET['meta_id'];
$sql = "DELETE FROM meta_data WHERE id = {$meta_id}";
if(mysqli_query($conn, $sql)){
    header("location: http://localhost:8080/projects/ecom/admin/show-meta.php");
}
mysqli_close($conn);

?>