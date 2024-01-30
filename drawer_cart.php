

<?php include 'admin/helper/dbconnect.php' ?>
<div class="offcanvas offcanvas-end" tabindex="-1" id="drawer-cart">
    <div class="offcanvas-header border-btm-black">
        <h5 class="cart-drawer-heading text_16">Your Cart </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="cart-content-area d-flex justify-content-between flex-column">
            <div class="minicart-loop custom-scrollbar" id="cart_container">
                <!-- minicart item -->
                 
            </div>
            <div class="minicart-footer">
                <div class="minicart-calc-area">
                    <div class="minicart-calc d-flex align-items-center justify-content-between">
                        <span class="cart-subtotal mb-0">Total</span>
                        <span class="cart-subprice" id="cart-subtotal"></span>
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

