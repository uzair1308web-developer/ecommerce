

<?php include 'admin/helper/dbconnect.php' ?>
<div class="offcanvas offcanvas-end" tabindex="-1" id="drawer-cart">
    <div class="offcanvas-header border-btm-black">
        <h5 class="cart-drawer-heading text_16">Your Cart (04)</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="cart-content-area d-flex justify-content-between flex-column">
            <div class="minicart-loop custom-scrollbar">
                <!-- minicart item -->
                <?php

                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $pro_id => $product) {
                        $sql = "SELECT * FROM products WHERE id = $pro_id";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                ?>

                        <div class="minicart-item d-flex" id="cart_container">
                            <div class="mini-img-wrapper">
                                <img class="mini-img" src="admin/upload/<?php echo $row['product_img'] ?>" alt="img">
                            </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="#"><?php echo  $product['name'] ?></a></h2>
                                <div class="misc d-flex align-items-end justify-content-between">
                                    <div class="quantity d-flex align-items-center justify-content-between">
                                        <button class="qty-btn dec-qty"><img src="assets/img/icon/minus.svg" alt="minus"></button>
                                        <input class="qty-input" type="number" name="qty" value="1" min="0">
                                        <button class="qty-btn inc-qty"><img src="assets/img/icon/plus.svg" alt="plus"></button>
                                    </div>
                                    <div class="product-remove-area d-flex flex-column align-items-end">
                                        <div class="product-price">$<?php echo  $product['price'] ?></div>
                                        
                                        <a href="javascript:void(0);" class="product-remove" onclick="remove_product('${}');">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php    }
                    }
                } else {
                    echo 'Your cart is empty.';
                }
                ?>


            </div>
            <div class="minicart-footer">
                <div class="minicart-calc-area">
                    <div class="minicart-calc d-flex align-items-center justify-content-between">
                        <span class="cart-subtotal mb-0">Subtotal</span>
                        <span class="cart-subprice">$1548.00</span>
                    </div>
                    <p class="cart-taxes text-center my-4">Taxes and shipping will be calculated at checkout.
                    </p>
                </div>
                <div class="minicart-btn-area d-flex align-items-center justify-content-between">
                    <a href="cart.php" class="minicart-btn btn-secondary">View Cart</a>
                    <a href="checkout.php" class="minicart-btn btn-primary">Checkout</a>
                </div>
            </div>
        </div>
        <div class="cart-empty-area text-center py-5 d-none">
            <div class="cart-empty-icon pb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg>
            </div>
            <p class="cart-empty">You have no items in your cart</p>
        </div>
    </div>
</div>

<script>

function remove_product(event){

    var id = $pro_id;
    $.ajax({
        type: "post",
        url: "remove_from_cart.php",

        
    })

}

</script>




