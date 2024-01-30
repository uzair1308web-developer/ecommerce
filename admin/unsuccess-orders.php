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
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Customer name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "SELECT * FROM order_data WHERE payment_status='payment initiated' ORDER BY sno";
                                $result = $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td>#<?php echo $row['sno'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['total_price'] ?></td>
                                            <td><span class="badge rounded-pill text-bg-danger">Pending</span></td>
                                            <td><?php echo $row['order_date'] ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center gap-3 fs-6">
                                                    <!-- <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="View detail" aria-label="Views"><i class="bi bi-eye-fill"></i></a> -->
                                                    <!-- <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a> -->
                                                    <a href="delete_unsuccess_order.php?order_id=<?php echo $row['sno'] ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                                </div>
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