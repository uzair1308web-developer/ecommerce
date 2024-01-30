<?php
session_start();
include 'admin/helper/dbconnect.php';
include 'admin/helper.php';
$response = [];

if (isset($_POST['isset_cart_form'])) {

    $quantity = $_POST['qty'];
    $name = $_POST['prod_name'];
    $price = $_POST['price'];
    $pro_id = $_POST['pro_id'];
    $disc_price = $_POST['disc_price'];
    $actual_price = $_POST['actual_price'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (!isset($_SESSION['cart'][$pro_id])) {
        $_SESSION['cart'][$pro_id] = array(

            'product_id' => $pro_id,
            'name' => $name,
            'price' => $price,
            'actual_price' => $actual_price,
            'quantity' => $quantity,
            'discount_price' => $disc_price,
        );
    }


    updateCart();

    // $subtotal = 0;
    // $subdiscount = 0;
    // $subactualprice = 0;
    // foreach ($_SESSION['cart'] as $productId => $item) {
    //     $sql = "SELECT * FROM products WHERE id = '$productId'";
    //     $result = mysqli_query($conn, $sql);
    //     $new_price = 0;
    //     if (mysqli_num_rows($result) > 0) {
    //         $product = mysqli_fetch_assoc($result);
    //         $single_img = image_parse($product['product_img']);
    //         $new_price = $item['price'] * $item['quantity'];
    //         $discount = $item['discount_price'] * $item['quantity'];
    //         $actualprice = $item['actual_price'] * $item['quantity'];
    //         $subactualprice += $actualprice;
    //         $subdiscount += $discount;
    //         $subtotal += $new_price;
    //         $_SESSION['total_price'] = $subtotal;
    //         $_SESSION['amount_payable'] = $subactualprice;
    //         $_SESSION['discount_amount'] = $subdiscount;
    //     }
    // }

 
    $response['status'] = true;
    $response['message'] = 'cart added';

    echo json_encode($response);
}




if (isset($_POST['isset_drawer_cart_data'])) {
    $product_data = [];
    // product name, img, qty, amount 
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $cartData = $_SESSION['cart'];
    } else {
        $cartData = array();
    }


    if (count($cartData) > 0) {
        foreach ($cartData as $single_cart) {
            $pro_id = $single_cart['product_id'];
            $quantity = $single_cart['quantity'];
            $price = $single_cart['price'];
            $actual_price = $single_cart['actual_price'];
            $disc_price = $single_cart['discount_price'];
            $pro_name = $single_cart['name'];

            $sql = "SELECT * FROM products WHERE id = $pro_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $single_img = image_parse($row['product_img']);
            }
            array_push($product_data, [
                'product_id' => $pro_id,
                'name' => $pro_name,
                'img' => $single_img[0],
                'disc_price' => $disc_price,
                'qty' => $quantity,
                'price' => $price,
            ]);
        }
    }
    $response['status'] = true;
    $response['message'] = 'product fetch';

    $response['product_data'] = $product_data;

    echo json_encode($response);
}


if (isset($_POST['isset_remove_product_from_cart'])) {
    $product_id = $_POST['pro_id'];

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        // unset($_SESSION['total_price']);
        // unset($_SESSION['amount_payable']);
        // unset($_SESSION['payable_amount']);
        
        updateCart();
    }
    
    if(count($_SESSION['cart']) <= 0){
        unset($_SESSION['shipping_name']);
        unset($_SESSION['shipping_amount']);
        unset($_SESSION['total_price']);
        unset($_SESSION['amount_payable']);
        unset($_SESSION['discount_amount']);
    }
    $response['status'] = true;
    $response['message'] = 'item remove';

    echo json_encode($response);
}

if (isset($_POST['isset_update_qty'])) {
    $pro_id = $_POST['pro_id'];
    $update = $_POST['update'];
    $quantity = $_POST['qty'];

    $_SESSION['cart'][$pro_id]['quantity']  = $quantity;

    // update total price  
    // $total_price = 0;
    // $amount_payable = 0;
    // $discount_amount = 0;
    // foreach($_SESSION['cart'] as $single_cart){
    //       $price = $single_cart['price'];
    //       $actual_price = $single_cart['actual_price'];
    //       $discount = $single_cart['discount_price'];
    //       $qty = $single_cart['quantity']; 
    //       $total_price += $price * $qty;
    //       $amount_payable += $actual_price * $qty;
    //       $discount_amount += $discount * $qty;
    // }

    // $_SESSION['total_price'] = $total_price;
    // $_SESSION['amount_payable'] = $amount_payable;
    // $_SESSION['discount_amount'] = $discount_amount;

    updateCart();
    

    $response['status'] = true;
    $response['message'] = 'qty update';
    $response['product_data'] =  json_encode($_SESSION['cart'][$pro_id]);
    $response['all_product_data'] =  json_encode($_SESSION['cart']);

    echo json_encode($response);
}

if (isset($_POST['isset_add_shipping'])) {

    $shipping_type = $_POST['shipping_name'];
    $shipping_price = $_POST['shipping_amount'];

    $_SESSION['shipping_name'] = $shipping_type;
    $_SESSION['shipping_amount'] = $shipping_price;

    // if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    //     $cartData = $_SESSION['cart'];
    // } else {
    //     $cartData = array();
    // }

    $total_pay = $_SESSION['amount_payable'] - $_SESSION['discount_amount'] + $shipping_price;


    $response['status'] = true;
    $response['message'] = 'shipping add';
    $response['shipping_name'] = $shipping_type;
    $response['shipping_price'] = $shipping_price;
    $response['payable'] = $total_pay;
    echo json_encode($response);
}
