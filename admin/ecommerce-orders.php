<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
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
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-12 d-flex">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Customer name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Delivery Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Detail</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "SELECT * FROM order_data WHERE payment_status='payment complete' ORDER BY sno";
                                $result = $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $date = $row['order_date'];
                                        
                                ?>
                                        <tr>
                                            <td>#<?php echo $row['sno'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php
                                                if ($row['total_price'] >= 0) {
                                                    echo '$' . $row['total_price'];
                                                } else {
                                                    echo "null";
                                                } ?></td>
                                            <td><span class="badge rounded-pill text-bg-success fw-lighter">Received</span></td>
                                            <td><?php
                                                if ($row['delivered'] == "") {
                                                    // echo "<span class='badge rounded-pill text-bg-info fw-lighter'>shipped</span>";
                                                    if ($row['order_shipped'] == "") {

                                                        if ($row['prep_shipment'] == "") {
                                                            echo "<span class='badge rounded-pill text-bg-info fw-lighter'>Placed</span>";
                                                        } else {
                                                            echo "<span class='badge rounded-pill text-bg-info fw-lighter'>Shipping</span>";
                                                        }
                                                    } else {
                                                        echo "<span class='badge rounded-pill text-bg-info fw-lighter'>Shipped</span>";
                                                    }
                                                } else {
                                                    echo "<span class='badge rounded-pill text-bg-success fw-lighter'>Delivered</span>";
                                                }
                                                ?></td>
                                            <td><?php echo $row['order_date'] ?></td>
                                            
                                            <td class="d-flex justify-content-center align-items-center gap-3">
                                            <a href="order-detail.php?id=<?php echo $row['sno'] ?>" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                                            <a href="delete_orders.php?order_id=<?php echo $row['sno'] ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div><!--end row-->

</main>

<?php include 'footer.php' ?>