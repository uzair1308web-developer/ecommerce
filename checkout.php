<?php session_start();
include 'php_helper.php';
include 'admin/helper.php';
include 'admin/helper/dbconnect.php';
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("location: shop.php");
    exit;
}
if (isset($_SESSION['shipping_name']) && isset($_SESSION['shipping_amount'])) {
    $ship_amount =  $_SESSION['shipping_amount'];
} else {
    $ship_amount = 0;
}

// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
$showError = false;
if (isset($_POST['isset_payment'])) {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $zip = $_POST['zcode'];
        $delivery = $_POST['payment'];
        $address = $_POST['address'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $showError = "Invalid email format";
        } else {

            $order_id = rand(time(), 10);
            $sql = "INSERT INTO order_data(order_id,name,email,contact,country,city,zip,address,shipping_charges,order_status,payment_status) values('$order_id','$name', '$email', '$contact', '$country', '$city', '$zip', '$address','$delivery','order initiated','payment initiated')";
            $result = mysqli_query($conn, $sql) or die("query failed");


            if ($result) {

                $_SESSION['order_id'] = $order_id;
                header("location: payment.php");
            } else {
                echo "First fill payment detail.";
            }
        }
    }
}
?>
<?php
include 'header.php';
?>
<!-- header end -->


<!-- breadcrumb start -->

<div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="https://spreethemesprevious.github.io/">Home</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Cart</li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Checkout</li>
        </ul>
    </div>
</div>
<!-- breadcrumb end -->


<main id="MainContent" class="content-for-layout">
    <div class="checkout-page mt-100">
        <div class="container">
            <div class="checkout-page-wrapper">
                <div class="row">
                    <div class="col-xl-12 col-lg-8 col-md-12 col-12">
                        <div class="section-header mb-3">
                            <h2 class="section-heading">Check out</h2>
                        </div>

                        <div class="checkout-progress overflow-hidden">
                            <ol class="checkout-bar px-0">
                                <li class="progress-step step-done">Cart</li>
                                <li class="progress-step step-active">Your Details</li>
                                <li class="progress-step step-todo">Payment</li>
                            </ol>
                        </div>


                        <div class="shipping-address-area">
                            <h2 class="shipping-address-heading pb-1">Shipping address</h2>
                            <div class="shipping-address-form-wrapper">
                                <?php

                                if ($showError) {
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> ' . $showError . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                                }
                                ?>
                                <form class="shipping-address-form common-form" method="post">
                                    <div class="row">
                                        <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                                            <div class="row">

                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Full name</label>
                                                        <input type="text" name="name" placeholder="Enter Full Name" class="px-3" required />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Email address</label>
                                                        <input type="email" name="email" placeholder="Enter your email" class="px-3" required />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Phone number</label>
                                                        <input type="text" name="contact" maxlength="10" placeholder="Enter your contact" class="px-3" requiered />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Country</label>
                                                        <select class="form-select" name="country" required>
                                                            <option selected disabled>select country</option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="India">India</option>
                                                            <option value="Italy">Italy</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Korea">Korea</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Russia">Russia</option>
                                                            <option value="Syria">Syria</option>
                                                            <option value="Turkey">Turkey</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">City</label>
                                                        <select class="form-select" name="city" required>
                                                            <option selected disabled>select city</option>
                                                            <option value="delhi">Delhi</option>
                                                            <option value="mumbai">Mumbai</option>
                                                            <option value="lucknow">Lucknow</option>
                                                            <option value="Pune">Pune</option>
                                                            <option value="chandigarh">Chandigarh</option>
                                                            <option value="Kashmir">Kashmir</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Zip code</label>
                                                        <input type="text" name="zcode" placeholder="Enter zip code" class="px-3" required />
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <fieldset>
                                                        <label class="label">Address</label>
                                                        <input type="text" name="address" placeholder="Enter address" class="px-3" required />
                                                    </fieldset>
                                                </div>
                                                <div class="shipping-address-area billing-area">
                                                    <div class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                                                        <a href="cart.php" class="checkout-page-btn minicart-btn btn-secondary">BACK TO CART</a>
                                                        <button name="isset_payment" class="checkout-page-btn minicart-btn btn-primary">PROCEED TO PAYMENT</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-12 col-12 mt-2 p-2" style="background-color: #f6f6f9;">

                                            <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Order summary</h4>
                                                <?php
                                                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                                                    $i = 1;
                                                    $subtotal = 0;
                                                    $subdiscount = 0;
                                                    $subactualprice = 0;
                                                    foreach ($_SESSION['cart'] as $productId => $item) {
                                                        $sql = "SELECT * FROM products WHERE id = '$productId'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $new_price = 0;
                                                        if (mysqli_num_rows($result) > 0) {
                                                            $product = mysqli_fetch_assoc($result);
                                                            $single_img = image_parse($product['product_img']);
                                                            $new_price = $item['price'] * $item['quantity'];
                                                            $discount = $item['discount_price'] * $item['quantity'];
                                                            $actualprice = $item['actual_price'] * $item['quantity'];
                                                            $subactualprice += $actualprice;
                                                            $subdiscount += $discount;
                                                            $subtotal += $new_price;
                                                            echo "<div class='minicart-item d-flex'>
                                                                <div class='mini-img-wrapper'>
                                                                    <img class='mini-img' src='admin/upload/$single_img[0]' alt='img'>
                                                                </div>
                                                                <div class='product-info'>
                                                                    <h2 class='product-title'><a href='#'>$product[product_name]</a></h2>
                                                                    <p class='product-vendor'>$$item[price] x $item[quantity]</p>
                                                                </div>
                                                                
                                                            </div>
                                                            ";
                                                        }
                                                        $i++;
                                                    }
                                                } else {
                                                    echo '<p>Your cart is empty.</p>';
                                                }

                                                ?>
                                                <div class="shipping-price">
                                                    <div class="d-flex justify-content-between" onclick="addshipping('amount','shipping_name')">

                                                        <label for="amount">
                                                            <div class="payment-detail">
                                                                <p class="fw-bold">Priority Shipping 3 days</p>
                                                                <p>$200</p>
                                                            </div>
                                                        </label>

                                                        <div class="payment-checkbox">
                                                            <?php
                                                            if ( isset($_SESSION['shipping_name'] ) && $_SESSION['shipping_name'] == 'Priority Shipping 3 days') {
                                                                echo '<input type="radio" checked name="payment" id="amount" value="200">';
                                                            }else{
                                                                echo '<input type="radio"  name="payment" id="amount" value="200" required>';
                                                            }
                                                            ?>

                                                            <input type="hidden" name="shipping_method" id="shipping_name" value="Priority Shipping 3 days">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between" onclick="addshipping('amount2','shipping_name2')">
                                                        <label for="amount2" >
                                                            <div class="payment-detail">
                                                                <p class="fw-bold">Regular Shipping 7 days</p>
                                                                <p>$100</p>
                                                            </div>
                                                        </label>
                                                        <div class="payment-checkbox">
                                                        <?php
                                                            if (isset($_SESSION['shipping_name'] ) && $_SESSION['shipping_name'] == "Regular Shipping 7 days") {
                                                                echo '<input type="radio" checked name="payment" id="amount2" value="100">';
                                                            }else{
                                                                echo '<input type="radio"  name="payment" id="amount2" value="100" required>';
                                                            }
                                                            ?>
                                                            <input type="hidden" name="shipping_method" id="shipping_name2" value="Regular Shipping 7 days">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                                                    $cartData = $_SESSION['cart'];
                                                } else {
                                                    $cartData = array();
                                                }

                                                if (count($cartData) > 0) {

                                                    if (isset($_SESSION['shipping_name'])){
                                                        $total_pay = $_SESSION['amount_payable'] - $_SESSION['discount_amount'] + $_SESSION['shipping_amount'];
                                                        $_SESSION['payable_amount'] = $total_pay;
                                                    }else{
                                                        $total_pay = $_SESSION['amount_payable'] - $_SESSION['discount_amount'];
                                                    }

                                                    // $last_total = $subactualprice - $shipping_charge - $subdiscount;
                                                    // $_SESSION['payable_amount'] = $last_total;
                                                    echo "<div class='cart-total-box mt-4 bg-transparent p-0'>
                                                    
                                                    <div class='subtotal-item subtotal-box'>
                                                        <h4 class='subtotal-title'>Subtotals:</h4>
                                                        <p class='subtotal-value'>$$subactualprice</p>
                                                    </div>
                                                    <div class='subtotal-item shipping-box'>
                                                        <h4 class='subtotal-title'>Shipping:</h4>
                                                        <p class='subtotal-value' id='shipping_amount'>$$ship_amount</p>
                                                    </div>
                                                    <div class='subtotal-item discount-box'>
                                                        <h4 class='subtotal-title'>Discount:</h4>
                                                        <p class='subtotal-value'>$$subdiscount</p>
                                                    </div>
                                                    <hr />
                                                    <div class='subtotal-item discount-box'>
                                                        <h4 class='subtotal-title'>Total:</h4>
                                                        <p class='subtotal-value' id='amount_payable'>$$total_pay</p>
                                                    </div>      
                                                </div>";
                                                }
                                                ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- footer start -->
<?php include 'footer.php' ?>
<!-- footer end -->

<!-- scrollup start -->
<button id="scrollup">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"></polyline>
    </svg>
</button>
<!-- scrollup end -->

<!-- drawer menu start -->
<?php include 'drawer_menu.php' ?>
<!-- drawer menu end -->

<!-- drawer cart start -->
<?php include 'drawer_cart.php' ?>
<!-- drawer cart end -->

<!-- all js -->
