<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php 
include 'helper/dbconnect.php';
$meta_id = $_GET['meta_id'];

?>

<main class="page-content">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">

                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Add Meta</h5>
                </div>

                <?php
                $showAlert = false;
                $showError = false;
                if(isset($_POST['update'])){

                    $sql = "UPDATE meta_data SET `page_name` = '{$_POST['pname']}', `url` = '{$_POST['url']}', `title` = '{$_POST['title']}', `keywords` = '{$_POST['keyword']}', `page_topic` = '{$_POST['pageType']}', `og_url` = '{$_POST['ogUrl']}', `og_title` = '{$_POST['ogTitle']}', `og_image_url` = '{$_POST['ogImgUrl']}', `twitter_title` = '{$_POST['twitter']}', `twitter_image_url` = '{$_POST['twitter-img-url']}', `description` = '{$_POST['description']}', `og_description` = '{$_POST['ogDescription']}', `twitter_description` = '{$_POST['twitterDescription']}' , `schema_` = '{$_POST['schema']}' WHERE id = $meta_id";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $showAlert = true;
                    } else {
                        $showError = true;
                    }
                }

                    if ($showAlert) {

                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                
                    <strong>Success</strong> Your meta data updated successfully.
                </div>";
                    }
                    if ($showError) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        
                        <strong>Sorry</strong> meta already added.
                        </div>";
                    }
                ?>
                <div class="card-body">
                    <?php 
                    $sql = "SELECT * FROM meta_data WHERE id = $meta_id";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
 
                    
                    <div class="border p-3 rounded">
                        <form method="post" class="row g-4" enctype="multipart/form-data">
                            <div class="col-6">
                                <label class="form-label">Page Name</label>
                                <input type="text" class="form-control" name="pname" value="<?php echo $row['page_name']?>" placeholder="Enter Page Name" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Url</label>
                                <input class="form-control" placeholder="Enter Url" name="url" value="<?php echo $row['url']?>" type="text" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Title</label>
                                <input class="form-control" placeholder="Page Title" name="title" value="<?php echo $row['title']?>" type="text" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Keywords</label>
                                <input class="form-control" type="text" name="keyword" value="<?php echo $row['keywords']?>" placeholder="Keywords" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Page Type / Page Topic</label>
                                <input class="form-control" type="text" name="pageType" value="<?php echo $row['page_topic']?>" placeholder="Page Topic" required>
                            </div>                    
                            <div class="col-6">
                                <label class="form-label">Og Url</label>
                                <input class="form-control" type="text" name="ogUrl" value="<?php echo $row['og_url']?>" placeholder="Og Url" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Og Title</label>
                                <input class="form-control" type="text" name="ogTitle" value="<?php echo $row['og_title']?>" placeholder="Og Title" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Og Image Url</label>
                                <input class="form-control" type="text" name="ogImgUrl" value="<?php echo $row['og_image_url']?>" placeholder="Og Image Url" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Twitter Title</label>
                                <input class="form-control" type="text" name="twitter" value="<?php echo $row['twitter_title']?>" placeholder="Twitter Title" required>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Twitter Image Url</label>
                                <input class="form-control" type="text" name="twitter-img-url" value="<?php echo $row['twitter_image_url']?>" placeholder="Twitter Image Url" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control"><?php echo $row['description']?></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Og Description</label>
                                <textarea name="ogDescription" id="ogDescription" class="form-control"><?php echo $row['og_description']?></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Twitter Description</label>
                                <textarea name="twitterDescription" id="twitterDescription" class="form-control"><?php echo $row['twitter_description']?></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Schema</label>
                                <textarea name="schema" id="schema" class="form-control"><?php echo $row['schema_']?></textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-content-center">
                                <button type="submit" class="btn btn-primary px-4" name="update">Updateutton>
                            </div>
                        </form>
                    </div>
                    <?php }
                }?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php' ?>