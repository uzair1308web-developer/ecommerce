<?php include 'header.php' ?>

<?php include 'helper/dbconnect.php' ?>
<?php include 'sidebar.php' ?>

<?php
$showAlert = false;
if (isset($_POST['update'])) {
    $cat_id = $_GET['cat_id'];
    $cat = $_POST['cat-name'];
    $slug = $_POST['cat-slug'];
    $sql = "UPDATE categories SET category_name ='$cat', category_slug = '$slug' where id = '$cat_id'";
    $result = mysqli_query($conn, $sql);
    if ($result){
        $showAlert = true;
    } else {
        echo "error";
    }
}
?>


<main class="page-content">


    <div class="card">
        <?php
        if ($showAlert) {

            echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    
        <strong>Success</strong> Your category updated successfully.
    </div>";
        }
        ?>
        <div class="card-header py-3">
            <h6 class="mb-0">Update Category</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-12 d-flex">
                    <div class="card border shadow-none w-100">
                        <div class="card-body">

                            <?php
                            $cat_id = $_GET['cat_id'];
                            $sql = "SELECT * FROM categories WHERE id ={$cat_id}";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {



                            ?>
                                    <form class="row g-3" method="post">
                                        <div class="col-12">
                                            <input type="hidden" name="cat_id" class="form-control" value="<?php echo $cat_id ?>" placeholder="">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="cat-name" value="<?php echo $row['category_name']; ?>" placeholder="Category name" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Slug</label>
                                            <input type="text" class="form-control" name="cat-slug" value="<?php echo $row['category_slug']; ?>" placeholder="Slug name" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" name="update">Update Category</button>
                                            </div>
                                        </div>
                                    </form>
                            <?php }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php' ?>