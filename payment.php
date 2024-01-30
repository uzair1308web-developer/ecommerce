<?php session_start();
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("location: shop.php");
    exit;
}
include 'admin/helper/dbconnect.php';
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
include 'header.php';
include 'admin/helper.php';

$order_id = $_SESSION['order_id'];
$fetch = "SELECT * FROM order_data where order_id = $order_id";
$result = mysqli_query($conn, $fetch);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    // $shipping_charge = $row['shipping_charges'];
    $name = $row['name'];
    $address = $row['address'];
    $city = $row['city'];
    $country = $row['country'];
}
?>
<!-- header end -->


<!-- breadcrumb start -->

<main id="MainContent" class="content-for-layout">
    <div class="checkout-page mt-4">
        <div class="container">
            <div class="checkout-page-wrapper">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-12">
                        <div class="shipping-address mb-4">
                            <div class="section-header mb-3">
                                <h3 class="d-none d-lg-block mb-0 heading_20">Shipping Address</h4>
                            </div>
                            <p class="m-0"><?php echo $name ?></p>
                            <p class="m-0"><?php echo $address ?></p>
                            <p class="m-0"><?php echo $city ?>, <?php echo $country ?></p>
                        </div>
                        <div class="select-payment">
                            <div class="section-header">
                                <h3 class="d-none d-lg-block mb-0 heading_20">Select Payment Method</h4>
                            </div>
                            <div class="payment-option-div">
                                <div class="a-box-inner">
                                    <div class="">
                                        <div class="">
                                            <div class=""><span class="text-bold">Your credit and debit cards</span></div>
                                        </div>
                                        <hr class="a-spacing-mini a-divider-normal">
                                    </div>
                                    <ul class="list-unstyled d-flex justify-content-around">
                                        <li>
                                            <a href="#">
                                                <label for="paytm">
                                                    <div class="a-row pmts-add-cc-default-trigger" onclick="selectpayment('paytm',event)">

                                                        <img alt="" src="https://imgs.search.brave.com/E1P18-ZShyc-zFbRBlk_SoZRiNMPszdgxBKpjQyYneQ/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9sZXZl/ci1jbGllbnQtbG9n/b3MuczMuYW1hem9u/YXdzLmNvbS82NTIx/Y2ZkMC1jYTE1LTQw/MjEtOGZjOC1lOGIz/YzNlMjg5N2QtMTQ4/MzEwNTI1NDc4MS5w/bmc" class="apx-add-pm-trigger-image" style="width: 100px;">
                                                    </div>
                                                </label>
                                            </a>
                                        </li>
                                        <hr class="a-spacing-mini a-divider-normal">
                                        <li>
                                            <a href="#">
                                                <label for="paypal">
                                                    <div class="a-row pmts-add-cc-default-trigger" onclick="selectpayment('paypal',event)">

                                                        <img alt="" src="https://imgs.search.brave.com/1DfyBY-t63tkQ27ZvIctOXgJ8C56tK2ed3HvxVG3VlI/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9hc3Nl/dHMuc3RpY2twbmcu/Y29tL2ltYWdlcy81/ODBiNTdmY2Q5OTk2/ZTI0YmM0M2M1MzAu/cG5n" class="apx-add-pm-trigger-image" style="width: 100px;">
                                                    </div>
                                                </label>
                                            </a>
                                        </li>
                                        <hr class="a-spacing-mini a-divider-normal">
                                        <li>
                                            <a href="#">
                                                <label for="razorpay">
                                                    <div class="a-row pmts-add-cc-default-trigger" onclick="selectpayment('razorpay',event)">
                                                        <img alt="" src="https://imgs.search.brave.com/wH36aoGNVWEtD-MvgdDCIqAsM5vs9hNiv14EKAD3K6c/rs:fit:860:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy84/Lzg5L1Jhem9ycGF5/X2xvZ28uc3Zn.svg" class="apx-add-pm-trigger-image" style="width: 100px;">
                                                    </div>
                                                </label>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <label for="razorpay">
                                                    <div class="a-row pmts-add-cc-default-trigger" onclick="selectpayment('cash_on_delivery',event)">
                                                        <img alt="" src="https://cdn-icons-png.flaticon.com/512/5278/5278592.png" class="apx-add-pm-trigger-image " style="width: 100px; height: 50px">
                                                    </div>
                                                </label>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-12">
                        <div class="cart-total-area checkout-summary-area">
                            <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Order summary</h3>
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

                            <?php
                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

                                $cartData = $_SESSION['cart'];
                            } else {
                                $cartData = array();
                            }

                            if (count($cartData) > 0) {
                               
                                echo "<div class='cart-total-box mt-4 bg-transparent p-0'>
                                        <?php
                                        
                                        ?>
                                        <div class='subtotal-item subtotal-box'>
                                            <h4 class='subtotal-title'>Subtotals:</h4>
                                            <p class='subtotal-value'>$$_SESSION[amount_payable]</p>
                                        </div>
                                        <div class='subtotal-item shipping-box'>
                                            <h4 class='subtotal-title'>Shipping:</h4>
                                            <p class='subtotal-value'>$$_SESSION[shipping_amount]</p>
                                        </div>
                                        <div class='subtotal-item discount-box'>
                                            <h4 class='subtotal-title'>Discount:</h4>
                                            <p class='subtotal-value'>$$_SESSION[discount_amount]</p>
                                        </div>
                                        <hr />
                                        <div class='subtotal-item discount-box'>
                                            <h4 class='subtotal-title'>Total:</h4>
                                            <p class='subtotal-value'>$$_SESSION[payable_amount]</p>
                                        </div>
                                        <div class='subtotal-item discount-box'>    
                                        <h4 class='subtotal-title'>Payment Option</h4>
                                        <p id='payment-option'>select payment</p>
                                    </div>


                                        <div class='mt-4 checkout-promo-code'>                                            
                                        <a href='#' class='btn-apply-code position-relative btn-secondary text-uppercase mt-3' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                            Proceed Payment
                                        </a>   
                                        </div>
                                    </div>";
                            } else {
                                echo "<div class='cart-total-box mt-4 bg-transparent p-0'>
                
                                    <div class='subtotal-item subtotal-box'>
                                        <h4 class='subtotal-title'>Subtotals:</h4>
                                        <p class='subtotal-value'>$0</p>
                                    </div>
                                    <div class='subtotal-item shipping-box'>
                                        <h4 class='subtotal-title'>Shipping:</h4>
                                        <p class='subtotal-value'>$0</p>
                                    </div>
                                    <div class='subtotal-item discount-box'>
                                        <h4 class='subtotal-title'>Discount:</h4>
                                        <p class='subtotal-value'>$0</p>
                                    </div>
                                       
                                    <div class='subtotal-item discount-box'>
                                        <h4 class='subtotal-title'>Total:</h4>
                                        <p class='subtotal-value'>$0</p>
                                    </div>
                                    <div class='mt-4 checkout-promo-code'>
                                    <a href='#' class='btn-apply-code position-relative btn-secondary text-uppercase mt-3' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                    Proceed Payment
                                </a>   
                                    </div>
                                </div>";
                            } ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</main>
<!-- Button trigger modal -->
<!-- Modal -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4 class="heading_24">Are you sure to confirm.</h4>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="order_btn" onclick="pay_now(event)">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- -->
<div id="confirmModal" class="modal fade">
    <div class="modal-dialog modal-confirm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <h4 class="modal-title w-100">Thank You!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Your order has been confirmed. Check your email for detials.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal" onclick="close_confirm_modal()">OK</button>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>



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


<!-- 
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    // function pay_now(event) {
    //     event.preventDefault();
    //     $.ajax({
    //         type: "post",
    //         url: "payment_ajax.php",
    //         data: {
    //             'isset_payment': 1
    //         },
    //         success: function(response) {
    //             let data = JSON.parse(response);
    //             //   console.log(response)
    //             var rzp1 = new Razorpay(data);
    //             rzp1.on('payment.failed', function(response) {
    //                 alert(response.error.code);
    //                 alert(response.error.description);
    //                 alert(response.error.source);
    //                 alert(response.error.step);
    //                 alert(response.error.reason);
    //                 alert(response.error.metadata.order_id);
    //                 alert(response.error.metadata.payment_id);
    //             });

    //             rzp1.open();

    //             // console.log(rzp1)


    //         }
    //     });

    // } -->
