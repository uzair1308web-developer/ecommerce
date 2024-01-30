<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php 
include 'helper/dbconnect.php';
$mail_id = $_GET['mail_id'];

?>

<main class="page-content">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">

                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Edit Mail</h5>
                </div>

                <?php
                $showAlert = false;
                $showError = false;
                if(isset($_POST['update'])){

                    $sql = "UPDATE mail_data SET `mail` = '{$_POST['mail']}' WHERE id = $mail_id";
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
                
                    <strong>Success</strong> Your mail id updated successfully.
                </div>";
                    }
                    if ($showError) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        
                        <strong>Sorry</strong> mail already added.
                        </div>";
                    }
                ?>
                <div class="card-body">
                    <?php 
                    $sql = "SELECT * FROM mail_data WHERE id = $mail_id";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
 
                    
                    <div class="border p-3 rounded">
                    <form method="post" class="row g-4" enctype="multipart/form-data">
                            <div class="col-12">
                                <h3>Mail of  <span class="text-danger"><?php echo $row['mail_of']?> </span> </h3>
                                <input class="form-control" placeholder="Enter mail" name="mail" value="<?php echo $row['mail']?>" type="email" required>
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