<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<main class="page-content">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Add Meta</h5>
                </div>
                <div class="border p-3 rounded overflow-scroll border-2">
                    <?php
                    include 'helper/dbconnect.php';
                    $sql = "SELECT * FROM meta_data";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <table class="table table-bordered overflow-scroll meta-table" id="myTable">


                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td >Page name</td>
                                    <td>Page url</td>
                                    <td>Page title</td>
                                    <td>keywords</td>
                                    <td>Page topic</td>
                                    <td>Distribution</td>
                                    <td>OG url</td>
                                    <td>OG title</td>
                                    <td>OG image url</td>
                                    <td>Twitter title</td>
                                    <td>Twitter image url</td>
                                    <td>Description</td>
                                    <td>OG Description</td>
                                    <td>Twitter Description</td>
                                    <td>Schema</td>
                                    <td>Created at</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['page_name'] ?></td>
                                        <td><?php echo $row['url'] ?></td>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><?php echo $row['keywords'] ?></td>
                                        <td><?php echo $row['page_topic'] ?></td>
                                        <td><?php echo $row['distribution'] ?></td>
                                        <td><?php echo $row['og_url'] ?></td>
                                        <td><?php echo $row['og_title'] ?></td>
                                        <td><?php echo $row['og_image_url'] ?></td>
                                        <td><?php echo $row['twitter_title'] ?></td>
                                        <td><?php echo $row['twitter_image_url'] ?></td>
                                        <td><?php echo $row['description'] ?></td>
                                        <td><?php echo $row['og_description'] ?></td>
                                        <td><?php echo $row['twitter_description'] ?></td>
                                        <td><?php echo $row['schema_'] ?></td>
                                        <td><?php echo $row['created_at'] ?></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                <a href="edit-meta.php?meta_id=<?php echo $row["id"]; ?> " class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="delete-meta.php?meta_id=<?php echo $row["id"]; ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
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