<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php include 'helper/dbconnect.php';
include 'media_modal.php';
include 'helper.php';
$pro_id = $_GET['product_id'];
?>



<main class="page-content">
    <div class="row">

        <div class="col-lg-8 mx-auto">
            <div class="card">
                <?php
                $showError = false;
                $showAlert = false;

                if (isset($_POST['update'])) {
                    $sql = "UPDATE products SET `product_img` = '{$_POST["single_img"]}',`other_images` = '{$_POST['multiple_img']}' , `product_name` = '{$_POST["pname"]}', `slug` = '{$_POST["slug"]}', `price` = '{$_POST["price"]}', `offer_price`='{$_POST["dprice"]}', `sku` = '{$_POST["sku"]}' WHERE id = '$pro_id'";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $showAlert = true;
                    } else {
                        $showError = true;
                    }
                }

                ?>

                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Add New Product</h5>
                </div>
                <div class="card-body">

                    <div class="border p-3 rounded">
                        <?php
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
                        ?>
                        <div>

                        </div>
                        <?php

                        $sql = "SELECT * FROM products WHERE id ={$pro_id}";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $single_img = image_parse($row['product_img']);
                                $other_img = image_parse($row['product_img']);
                                
                        ?>
                                <form method="post" class="row g-3" enctype="multipart/form-data">
                                    <div class="col-12">
                                        <label class="form-label">Product title</label>
                                        <input type="text" class="form-control" name="pname" value="<?php echo $row['product_name']; ?>" placeholder="Product title" required="">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Slug</label>
                                        <input class="form-control" placeholder="Slug name" value="<?php echo $row['slug']; ?>" name="slug" type="text" required="">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">SKU</label>
                                        <input class="form-control" placeholder="enter sku code" value="<?php echo $row['sku']; ?>" name="sku" type="text" required="">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <label for="formFile" class="form-label">Main Image</label>
                                        <div class="border border-dashed p-3">
                                            <div class="selected-media-box d-flex justify-content-center" id="selected-media-box">
                                                <!-- the selected image will show here  -->
                                                <img src='upload/<?php echo $single_img[0];?>' style='max-height:150px; width:150px;'>
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
                                    <img src='' style='max-height:150px; width:150px;'>
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
                                    <div class="col-lg-6">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price" value="<?php echo $row['price']; ?>" placeholder="Price" required="">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Discounted Price</label>
                                        <input type="text" class="form-control" name="dprice" value="<?php echo $row['offer_price']; ?>" placeholder="Price" required="">
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Publish on website
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4" name="update">Submit</button>
                                    </div>
                                </form>


                        <?php }
                        } else {
                            $other_img = [];
                        }
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</main>
<?php include 'footer.php' ?>