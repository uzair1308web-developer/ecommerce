<?php include 'helper/dbconnect.php' ?>
<aside class="sidebar-wrapper">
    <div class="sideBar-container">
        <div class="order-menu">
            <div class="comp-logo">
                <img src="assets/images/brand-logo-2.png" width="140" alt="" />
            </div>
        </div>
        <div class="other-order ">
            <table class="table table-bordered align-middle order-table">
                <thead>
                    <tr>
                        <th class=" border-0 fw-lighter font-20">Orders</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM order_data WHERE payment_status='payment complete' ORDER BY sno";
                    $result = $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>

                            <tr>
                                <td><?php echo $row['name'] ?></td>

                                <td class="d-flex justify-content-center align-items-center">
                                    <a href="order-detail.php?id=<?php echo $row['sno'] ?>" class="list-group-item mx-2">
                                        <i class="bi bi-box-arrow-in-up-right"></i></a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</aside>