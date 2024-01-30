<?php
include 'helper/dbconnect.php';

function image_parse($image_data)
{
    $image_data = json_decode($image_data, true);
    $img_src = [];
    foreach ($image_data as $single_img) {

        global $conn;

        $file_id = $single_img['file_id'];
        //  get image from database 
        $sql = "SELECT * FROM `media_data` where `id` = '$file_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $src = $row['image'];
            array_push($img_src, $src);
        }
    }
    return $img_src;
}


function updateCart(){
 
    $subtotal = 0;
    $subdiscount = 0;
    $subactualprice = 0;
    foreach ($_SESSION['cart'] as $item) {
        $new_price = 0;
        $new_price = $item['price'] * $item['quantity'];
        $discount = $item['discount_price'] * $item['quantity'];
        $actualprice = $item['actual_price'] * $item['quantity'];
        $subactualprice += $actualprice;
        $subdiscount += $discount;
        $subtotal += $new_price;
        $_SESSION['total_price'] = $subtotal;
        $_SESSION['amount_payable'] = $subactualprice;
        $_SESSION['discount_amount'] = $subdiscount;
    }
 
 }