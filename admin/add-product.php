<?php include 'header.php' ?>
<?php include 'sidebar.php';
include 'media_modal.php'; ?>

<!--image modal -->



<!--end modal -->
<main class="page-content">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Add New Product</h5>
                </div>
                <div class="card-body">
                    <div class="border p-3 rounded">

                        <div>
                            <?php
                            include 'helper/dbconnect.php';
                            $showError = false;
                            $showAlert = false;
                            if (isset($_POST['add'])) {
                            
                                $single_img = mysqli_real_escape_string($conn, $_POST['single_img']);
                                // echo $single_img;
                                $multiple_img = mysqli_real_escape_string($conn, $_POST['multiple_img']);
                                $name = mysqli_real_escape_string($conn, $_POST['pname']);
                                $slug = mysqli_real_escape_string($conn, $_POST['slug']);
                                $sku = mysqli_real_escape_string($conn, $_POST['sku']);
                                $category = mysqli_real_escape_string($conn, $_POST['category']);
                                $price = mysqli_real_escape_string($conn, $_POST['price']);
                                $dprice = mysqli_real_escape_string($conn, $_POST['dprice']);
                                $sql = "INSERT INTO products (category_id, product_img, other_images, product_name, slug, price, offer_price, sku) VALUES ('{$category}','{$single_img}', '{$multiple_img}', '{$name}', '{$slug}', '{$price}', '{$dprice}', '{$sku}')";
                                if (mysqli_query($conn, $sql)) {
                                    $showAlert = true;
                                } else {
                                    $showError = true;
                                }
                            }

                            if ($showAlert) {

                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        
                            <strong>Success</strong> Your Product added successfully.
                        </div>";
                            }
                            if ($showError) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                
                                <strong>Sorry</strong> category already added.
                                </div>";
                            }
                        //     ?>
                        </div>


                        <form method="post" class="row g-3" enctype="multipart/form-data">
                            <div class="col-12">
                                <label class="form-label">Product title</label>
                                <input type="text" class="form-control" name="pname" placeholder="Product title" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Slug</label>
                                <input class="form-control" placeholder="Slug name" name="slug" type="text" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">SKU</label>
                                <input class="form-control" placeholder="enter sku code" name="sku" type="text" required>
                            </div>
                            <div class="col-12 mt-4">
                                <label for="formFile" class="form-label">Main Image</label>
                                <div class="border border-dashed p-3">
                                    <div class="selected-media-box" id="selected-media-box">
                                        <!-- the selected image will show here  -->

                                        <!-- this input field will contain image ids  -->
                                        <input type="hidden" name="single_img" id="final-selected-media-input" value="">

                                        <p class="form-feedback invalid-feedback" data-name="logo">
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mt-2">

                                        <a style="background-color: transparent" href="javascript:;" onclick="setMediaSelection('final-selected-media-input','selected-media-box',false)">
                                            <img src="upload/attachment.png">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <label for="formFile" class="form-label">Other Images</label>
                                <div class="border border-dashed p-3">
                                    <div class="selected-media-box" id="selected-media-box2">
                                        <input type="hidden" name="multiple_img" id="final-selected-media-input2" value="">
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center mt-2">
                                        <a style="background-color: transparent" href="javascript:;" onclick="setMediaSelection('final-selected-media-input2','selected-media-box2',true)" class="image">
                                            <!-- <input type="hidden" value="multipleImg" class="input"> -->
                                            <img src="upload/attachment.png">
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
                                <label class="form-label">Category</label>

                                <select class="form-select" name="category">
                                    <option disabled selected>Select Category</option>
                                    <?php
                                    include 'helper/dbconnect.php';
                                    $sql = "SELECT * FROM categories";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id']}'>{$row['category_name']}</option> ";
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="col-lg-6">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" placeholder="Price" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Discounted Price</label>
                                <input type="text" class="form-control" name="dprice" placeholder="Price" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4" name="add">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php include 'footer.php' ?>