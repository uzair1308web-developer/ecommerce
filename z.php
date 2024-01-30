<div class='cart-total-box mt-4 bg-transparent p-0'>
                                    <?php
                                    $total = $subtotal + 20;
                                    ?>
                                    <div class='subtotal-item subtotal-box'>
                                        <h4 class='subtotal-title'>Subtotals:</h4>
                                        <p class='subtotal-value'>$<?php echo $subtotal ?></p>
                                    </div>
                                    <div class='subtotal-item shipping-box'>
                                        <h4 class='subtotal-title'>Shipping:</h4>
                                        <p class='subtotal-value'>$50</p>
                                    </div>
                                    <div class='subtotal-item discount-box'>
                                        <h4 class='subtotal-title'>Discount:</h4>
                                        <p class='subtotal-value'>$30</p>
                                    </div>
                                    <hr />
                                    <div class='subtotal-item discount-box'>
                                        <h4 class='subtotal-title'>Total:</h4>
                                        <p class='subtotal-value'>$<?php echo $total ?></p>
                                    </div>


                                    <div class='mt-4 checkout-promo-code'>
                                        <a href='#' class='btn-apply-code position-relative btn-secondary text-uppercase mt-3'>
                                            Proceed Payment
                                        </a>
                                    </div>
                                </div>