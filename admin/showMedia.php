<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<main class="page-content">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Media Detail</h5>
                </div>
                <div class="border p-3 rounded overflow-scroll border-2">
                    <?php
                    include 'helper/dbconnect.php';
                    $sql = "SELECT * FROM media_data";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <table class="table table-bordered overflow-scroll">


                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Image</td>
                                    <td>Title</td>
                                    <td>Alt Text</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><img src="upload/<?php echo $row['image'] ?>" alt="" style="width: 100px; height=100px"></td>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><?php echo $row['alt_text'] ?></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                <a href="edit_media.php?media_id=<?php echo $row["id"]; ?> " class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="delete_media.php?media_id=<?php echo $row["id"]; ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<?php include 'footer.php' ?>