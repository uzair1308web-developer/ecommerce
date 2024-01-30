<?php
session_start();

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    
    if(isset($_SESSION['cart'][$product_id])){
        unset($_SESSION['cart'][$product_id]);

    }
    
}
header("location:http://localhost:8080/projects/ecom/product.php?id=".$product_id);

?>