<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php 
include 'helper/dbconnect.php';
$media_id = $_GET['media_id'];

?>

<main class="page-content">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">

                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Edit Media</h5>
                </div>

                <?php
                $showAlert = false;
                $showError = false;
                if(isset($_POST['update'])){

                    $sql = "UPDATE `media_data` SET `title` = '{$_POST['title']}', `alt_text` = '{$_POST['alt-text']}' WHERE `id` = '$media_id'";
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
                    $sql = "SELECT * FROM media_data WHERE id = $media_id";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
 
                    
                    <div class="border p-3 rounded">
                        <form method="post" class="row g-4" >
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <img src="upload/<?php echo $row['image']?>" alt="" style="width: 150px; height: 150px;">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="<?php echo $row['title']?>" placeholder="Enter Page Name" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Alt Text</label>
                                <input class="form-control" placeholder="Enter text" name="alt-text" value="<?php echo $row['alt_text']?>" type="text" required>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-content-center">
                                <button type="submit" class="btn btn-primary px-4" name="update">Update</button>
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