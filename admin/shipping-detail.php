<?php include 'header.php' ?>

<?php include 'helper/dbconnect.php' ?>


<?php include 'helper/dbconnect.php';
include 'helper.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM order_data WHERE sno = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $ndate = date(' l d M, Y');
}
?>
<aside class="sidebar-wrapper">
    <div class="sideBar-container">
        <div class="order-menu">
            <div class="comp-logo">
                <img src="assets/images/brand-logo-2.png" width="140" alt="" />
            </div>
        </div>
        <div class="other-order p-4">
            <h3>Hi, <span class="font-20"><?php echo $row['name'] ?></span></h3>
            <hr>
        </div>
    </div>
</aside>

<main class="page-content">
    <div class="card">
        <div class="card-header py-3">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-lg-4 col-md-6 me-auto">
                    <h5 class="mb-1">Order #<?php echo $row['order_id'] ?></h5>
                    <p class="mb-0"><?php echo $ndate ?></p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-xl-1 row-cols-xxl-1">
                <div class="card border shadow-none">
                    <div class="d-flex justify-content-between">

                        <div class="data-div d-flex flex-column">
                            <?php
                            $prod_detail = json_decode($row['product_detail'], true);
                            $prod_detail =  array_values($prod_detail);
                            foreach ($prod_detail as $prod => $data) {
                                $sql1 = "SELECT * FROM products WHERE id = $data[product_id]";
                                $result1 = mysqli_query($conn, $sql1);
                                if (mysqli_num_rows($result1) > 0) {
                                    $row1 = mysqli_fetch_assoc($result1);
                                    $single_img = image_parse($row1['product_img']);

                            ?>
                                    <div class="p-2 d-flex">
                                        <img src="upload/<?php echo $single_img[0] ?>" style="height: 100px; width: 100px" alt="">
                                        <div class="box">
                                            <p class="font-20 m-2"><?php echo $row1['product_name'] ?></p>
                                            <p class="m-2">SKU: <?php echo $row1['sku'] ?></p>
                                            <p class="m-2">Quantity: <?php echo $data['quantity'] ?></p>
                                        </div>
                                    </div>
                            <?php }
                            } ?>

                        </div>

                        <div class="p-2">
                            <div class="box">
                                <div class="head d-flex">
                                    <i class="bi bi-truck font-30"></i>
                                    <p class="font-20 m-2 fw-bold text-black">Shipped</p>
                                </div>
                            </div>

                            <?php

                            if (isset($_POST['update-status'])) {
                                $update = "UPDATE `order_data` SET `prep_shipment` = '{$_POST['shipping']}', `order_shipped` = '{$_POST['shipped']}', `delivered` = '{$_POST['delivered']}' WHERE `sno` = '$id'";
                                $success = mysqli_query($conn, $update);
                                if($success){
                                    echo "<script>window.location.reload()</script>";
                                }
                            }
                            ?>

                            <div class="progress-box p-0">
                                <form method="post">
                                    <ul class="p-0 list-unstyled">
                                        <li class="li-item">
                                            <i class="bi bi-truck-flatbed icon"></i>
                                            <div class="progress one active">
                                                <p></p>
                                                <i class="uil uil-check"></i>
                                                <input type="hidden" name="placed" id="placed" value="">
                                            </div>
                                            <p class="text">Order Placed</p>
                                        </li>
                                        <li class="li-item">
                                            <i class="bi bi-life-preserver icon"></i>
                                            <div class="progress two ">
                                                <p></p>
                                                <i class="uil uil-check"></i>
                                                <input type="hidden" name="shipping" id="shipping" value="<?php echo $row['prep_shipment'] ?>">
                                            </div>
                                            <p class="text">Prepairing <br> Shipment</p>
                                        </li>
                                        <li class="li-item">
                                            <i class="bi bi-check icon"></i>
                                            <div class="progress three ">
                                                <p></p>
                                                <i class="uil uil-check"></i>
                                                <input type="hidden" name="shipped" id="shipped" value="<?php echo $row['order_shipped'] ?>">
                                            </div>
                                            <p class="text mx-2">Shipped</p>
                                        </li>
                                        <li class="li-item">
                                            <i class="bi bi-check2-circle icon"></i>
                                            <div class="progress four ">
                                                <p></p>
                                                <i class="uil uil-check"></i>
                                                <input type="hidden" name="delivered" id="delivered" value="<?php echo $row['delivered'] ?>">
                                            </div>
                                            <p class="text mx-1">Delivered</p>
                                        </li>
                                        <li><button class="btn btn-sm btn-success mt-1" name="update-status" id="update-status">update</button></li>
                                    </ul>
                                </form>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="order-detail">
                            <p><strong>Track:</strong> #<?php echo $row['order_id'] ?> </p>
                            <p> <strong>Delivery Method: </strong> Ground Parcel</p>
                            <p><strong>Shipped To:</strong> <?php echo $row['address'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- script for progress -->
    <script>
        const one = document.querySelector(".one");
        const two = document.querySelector(".two");
        const three = document.querySelector(".three");
        const four = document.querySelector(".four");
        const five = document.querySelector(".five");
        const placed = document.getElementById("placed").value;
        const shipping = document.getElementById("shipping").value;
        const shipped = document.getElementById("shipped").value;
        const delivered = document.getElementById("delivered").value;

        if (shipping == "shipping") {
            two.classList.add("active");
            one.classList.add("active");
        } else {
            one.classList.add("active");
            two.classList.remove("active");
        }

        if (shipped == "shipped") {
            three.classList.add("active");
        } else {
            three.classList.remove("active");
        }

        if (delivered == "delivered") {
            four.classList.add("active");
        } else {
            four.classList.remove("active");

        }

        two.onclick = function() {
            $("#shipping").attr("value", "shipping")
            one.classList.add("active");
            two.classList.add("active");
            three.classList.remove("active");
            four.classList.remove("active");
            five.classList.remove("active");
        }

        three.onclick = function() {
            $("#shipped").attr("value", "shipped")
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            four.classList.remove("active");
            five.classList.remove("active");
        }
        four.onclick = function() {
            $("#delivered").attr("value", "delivered")
            // console.log($("#delivered"))
            one.classList.add("active");
            two.classList.add("active");
            three.classList.add("active");
            four.classList.add("active");
            five.classList.remove("active");
        }
    </script>
    <!-- end script for progress -->

</main>

<?php include 'footer.php' ?>