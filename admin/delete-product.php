<?php include 'helper/dbconnect.php';

$prod_id = $_GET['product_id'];
$sql = "DELETE FROM products WHERE id = {$prod_id}";
if(mysqli_query($conn, $sql)){
    header("location: http://localhost:8080/projects/ecom/admin/product-list.php");
}

mysqli_close($conn);

?>
