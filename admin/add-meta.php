<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<main class="page-content">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Add Meta</h5>
                </div>
                <div class="card-body">
                    <?php 
                    include 'helper/dbconnect.php';
                    $showError = false;
                    $showAlert = false;
                    if(isset($_POST['save'])){
                        $page_name = mysqli_real_escape_string($conn, $_POST['pname']);
                        $url = mysqli_real_escape_string($conn, $_POST['url']);
                        $title = mysqli_real_escape_string($conn, $_POST['title']);
                        $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);
                        $page_type = mysqli_real_escape_string($conn, $_POST['pageType']);
                        $distribution = mysqli_real_escape_string($conn, $_POST['distribution']);
                        $og_url = mysqli_real_escape_string($conn, $_POST['ogUrl']);
                        $og_title = mysqli_real_escape_string($conn, $_POST['ogTitle']);
                        $og_img_url = mysqli_real_escape_string($conn, $_POST['ogImgUrl']);
                        $twitter_title = mysqli_real_escape_string($conn, $_POST['twitter']);
                        $twitter_img_url = mysqli_real_escape_string($conn, $_POST['twitter-img-url']);
                        $description = mysqli_real_escape_string($conn, $_POST['description']);
                        $og_description = mysqli_real_escape_string($conn, $_POST['ogDescription']);
                        $twitter_description = mysqli_real_escape_string($conn, $_POST['twitterDescription']);
                        $schema = mysqli_real_escape_string($conn, $_POST['schema']);
                        $sql = "INSERT INTO `meta_data` (`page_name`,`url`,`title`,`keywords`,`page_topic`,`distribution`,`og_url`,`og_title`,`og_image_url`,`twitter_title`,`twitter_image_url`,`description`,`og_description`,`twitter_description`,`schema_`) VALUES('$page_name','$url','$title','$keyword','$page_type','$distribution','$og_url','$og_title','$og_img_url','$twitter_title','$twitter_img_url','$description','$og_description','$twitter_description','$schema')";
                        if(mysqli_query($conn,$sql)){
                            $showAlert = true;
                        }else{
                            $showError = true;
                        }
                    }
                    if ($showAlert) {

                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                
                    <strong>Success</strong> Your meta data added successfully.
                </div>";
                    }
                    if ($showError) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        
                        <strong>Sorry</strong> meta already added.
                        </div>";
                    }
                    ?>
                    
                    <div class="border p-3 rounded">
                        <form method="post" class="row g-4" enctype="multipart/form-data">
                            <div class="col-6">
                                <label class="form-label">Page Name</label>
                                <input type="text" class="form-control" name="pname" placeholder="Enter Page Name" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Url</label>
                                <input class="form-control" placeholder="Enter Url" name="url" type="text" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Title</label>
                                <input class="form-control" placeholder="Page Title" name="title" type="text" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Keywords</label>
                                <input class="form-control" type="text" name="keyword" placeholder="Keywords" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Page Type / Page Topic</label>
                                <input class="form-control" type="text" name="pageType" placeholder="Page Topic" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Distrbution</label>
                                
                                <select class="form-select" name="distribution" required>
                                    <option  value="">Select Distribution</option>
                                    <option value="Global">Global</option>
                                    <option value="Local">Local</option>
                                </select>
                            </div>
                            
                            <div class="col-6">
                                <label class="form-label">Og Url</label>
                                <input class="form-control" type="text" name="ogUrl" placeholder="Og Url" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Og Title</label>
                                <input class="form-control" type="text" name="ogTitle" placeholder="Og Title" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Og Image Url</label>
                                <input class="form-control" type="text" name="ogImgUrl" placeholder="Og Image Url" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Twitter Title</label>
                                <input class="form-control" type="text" name="twitter" placeholder="Twitter Title" required>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Twitter Image Url</label>
                                <input class="form-control" type="text" name="twitter-img-url" placeholder="Twitter Image Url" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control"  ></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Og Description</label>
                                <textarea name="ogDescription" id="ogDescription" class="form-control"></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Twitter Description</label>
                                <textarea name="twitterDescription" id="twitterDescription" class="form-control"></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Schema</label>
                                <textarea name="schema" id="schema" class="form-control"></textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-content-center">
                                <button type="submit" class="btn btn-primary px-4" name="save">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php' ?>