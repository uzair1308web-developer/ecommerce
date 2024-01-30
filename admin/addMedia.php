<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php
// include 'helper/dbconnect.php';
// if (isset($_POST['add'])) {
//     $error = array();
//     $file_name = $_FILES['fileToUpload']['name'];
//     $file_tmp = $_FILES['fileToUpload']['tmp_name'];
//     echo $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
//     echo 'hello';
//     // $file_ext = strtolower(end(explode('.', $file_name)));
//     // $extensions = array("jpeg", "jpg", "png");
//     // if(in_array($file_ext, $extensions) === false){
//     //     $error[] = "this extension file is not allowed"; 
//     // }
//     // if(empty($error) == true){
//     //     move_uploaded_file($file_tmp, "upload/".$file_name);
//     // }
//     // else{
//     //     print_r($error);
//     //     die();
//     // }

//     // session_start();
//     // $name = mysqli_real_escape_string($conn, $_POST['pname']);
//     // $slug = mysqli_real_escape_string($conn, $_POST['slug']);
//     // $sku = mysqli_real_escape_string($conn, $_POST['sku']);
//     // $category =mysqli_real_escape_string($conn, $_POST['category']);
//     // $price = mysqli_real_escape_string($conn,$_POST['price']);
//     // $dprice = mysqli_real_escape_string($conn,$_POST['dprice']);
//     // $sql = "INSERT INTO categories (category_id, product_img, product_name, slug, price, offer_price, sku) VALUES ('{$file_name}', '{$name}', '{$slug}', '{$price}', '{$dprice}', '{$sku}')";

// }
?>
<main class="page-content">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Add Media</h5>
                </div>
                <div class="card-body">
                <?php
                            include 'helper/dbconnect.php';
                            
                            if (isset($_POST['add'])) {
                                
                                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                                    $file_name = $_FILES['images']['name'][$key];
                                    $tmpFilePath = $_FILES['images']['tmp_name'][$key];

                                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                                    $new_name = mt_rand(1000, 100000) . time() .'.'. $file_ext;

                                    move_uploaded_file($tmpFilePath, "upload/$new_name");
                                    
                                    $sql = "INSERT INTO media_data ( `image`) VALUES ( '{$new_name}')";
                                    if (mysqli_query($conn, $sql)) {
                                        $showAlert = true;
                                    } else {
                                        $showError = true;
                                    }
                                }
                                }
                    
                    ?>
                    <div class="border p-3 rounded">
                    <form method="post" class="row g-3" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Add Media</label>
                            <input class="form-control" type="file" id="formFile" name="images[]"  multiple>
                          </div>
                        <div class="col-12 mt-2 d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-primary px-4" name="add">Add</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php' ?>