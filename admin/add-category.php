<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php 
$showAlert = false;
$showError = false;
if(isset($_POST['add'])){
    include 'helper/dbconnect.php';
    $category_name = mysqli_real_escape_string($conn, $_POST['cat-slug']);
    $category_slug = mysqli_real_escape_string($conn, $_POST['cat-slug']);
    $sql = "SELECT * FROM categories where category_name = '$category_name' AND category_slug = '$category_slug'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $showError = true;
    }else{
        $sql1 = "INSERT INTO categories (category_name, category_slug) VALUES('$category_name', '$category_slug')";
        if(mysqli_query($conn, $sql1)){
            $showAlert = true;
        }
    }
}

?>
<main class="page-content">
    <div class="card">
        <div class="card-header py-3">
            <h6 class="mb-0">Add Product Category</h6>
        </div>
        <div class="card-body">

        <?php
        if ($showAlert) {
            
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    
        <strong>Success</strong> Your category added successfully.
    </div>";
        }
        if($showError){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            
            <strong>Sorry</strong> category already added.
            </div>";
        }
            ?>
            <div class="row">
                <div class="col-12 col-lg-12 d-flex">
                    <div class="card border shadow-none w-100">
                        <div class="card-body">
                            <form class="row g-3" method="post" >
                                <div class="col-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="cat-name" placeholder="Category name" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" name="cat-slug" placeholder="Slug name" required>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary" name="add">Add Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php' ?>