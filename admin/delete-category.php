<?php include 'helper/dbconnect.php';

$cat_id = $_GET['cat_id'];
$sql = "DELETE FROM categories WHERE id = {$cat_id}";
if(mysqli_query($conn, $sql)){
    header("location: http://localhost:8080/projects/ecom/admin/list-category.php");
}

mysqli_close($conn);

?>