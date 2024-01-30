<?php include 'header.php' ?>
<?php include 'orderDetailSidebar.php' ?>
<?php include 'helper/dbconnect.php' ?>


<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">eCommerce</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Order details</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM order_data WHERE sno = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $date = $row['order_date'];
        $ndate = date_create($date);
        $ndate =  date_format($ndate, "d M, Y, l");
    }
    ?>
    <div class="card">
        <div class="card-header py-3">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-lg-4 col-md-6 me-auto">
                    <h5 class="mb-1"><?php echo $ndate ?></h5>
                    <p class="mb-0">Order ID : #<?php echo $row['order_id'] ?></p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-xl-2 row-cols-xxl-3">
                <div class="col">
                    <div class="card border shadow-none radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-light-primary border-0">
                                    <i class="bi bi-person text-primary"></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Customer</h6>
                                    <p class="mb-1"><?php echo $row['name'] ?></p>
                                    <p class="mb-1"><?php echo $row['email'] ?></p>
                                    <p class="mb-1"><?php echo $row['contact'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border shadow-none radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-light-success border-0">
                                    <i class="bi bi-truck text-success"></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Order info</h6>
                                    <p class="mb-1"><strong>Shipping</strong> : Red Express</p>
                                    <p class="mb-1"><strong>Pay Method</strong> : Master Card</p>
                                    <p class="mb-1"><strong>Status</strong> : New</p>
                                </div>
                                <button class="btn btn-sm btn-info" style="margin-left: 42px; margin-top: 65px;"><a href="shipping-detail.php?id=<?php echo $row['sno'] ?>" class="text-white">More detail<a></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border shadow-none radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-light-danger border-0">
                                    <i class="bi bi-geo-alt text-danger"></i>
                                </div>
                                <div class="info">
                                    <h6 class="mb-2">Deliver to</h6>
                                    <p class="mb-1"><strong>City</strong> : <?php echo $row['city'] ?>,<?php echo $row['country'] ?></p>
                                    <p class="mb-1"><strong>Address</strong> : <?php echo $row['address'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card border shadow-none radius-10">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $prod_detail = json_decode($row['product_detail'], true);
                                        $prod_detail =  array_values($prod_detail);
                                        
                                        foreach ($prod_detail as $prod => $data) {
                                            $sql1 = "SELECT * FROM products WHERE id = $data[product_id]";
                                            $result1 = mysqli_query($conn,$sql1);
                                            if(mysqli_num_rows($result1) > 0){
                                                $row1 = mysqli_fetch_assoc($result1);
                                                
                                            
                                        ?>

                                            <tr>
                                                <td>
                                                    <div class="orderlist">
                                                        <a class="d-flex align-items-center gap-2" href="javascript:;">
                                                            <div class="product-box">
                                                                <img src="upload/<?php echo $row1['product_img']?>" alt="hello">
                                                            </div>
                                                            <div>
                                                                <p class="mb-0 product-title"><?php echo $data['name'] ?></p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>$ <?php echo $data['price'] ?></td>
                                                <td><?php echo $data['quantity'] ?></td>
                                                <td>$ <?php echo $data['price'] * $data['quantity'] ?></td>
                                            </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card border shadow-none bg-light radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div>
                                    <h5 class="mb-0">Order Summary</h5>
                                </div>
                                <div class="ms-auto">
                                    <button type="button" class="btn alert-success radius-30 px-4">Confirmed</button>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <div>
                                    <p class="mb-0">Subtotal</p>
                                </div>
                                <div class="ms-auto">
                                    <h5 class="mb-0">$<?php echo $row['total_price'] ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!--end row-->

        </div>
    </div>

</main>

<?php include 'footer.php' ?>