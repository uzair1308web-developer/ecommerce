<?php include 'helper/dbconnect.php';

$cat_id = $_GET['order_id'];
$sql = "DELETE FROM order_data WHERE sno = {$cat_id}";
if(mysqli_query($conn, $sql)){
    header("location: http://localhost:8080/projects/ecom/admin/ecommerce-orders.php");
}

mysqli_close($conn);

?>