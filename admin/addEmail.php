<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>

<main class="page-content">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Add Email</h5>
                </div>
                <div class="card-body">
                    <?php 
                    include 'helper/dbconnect.php';
                    $showError = false;
                    $showAlert = false;
                    if(isset($_POST['save'])){
                        $mail_of = mysqli_real_escape_string($conn, $_POST['mail-of']);
                        $mail = mysqli_real_escape_string($conn,$_POST['mail']);
                        if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                            $showError = "Invalid email format";
                        }else{
                            //check whether email exists
                            $existEmail = "SELECT * FROM `mail_data` WHERE mail = '$mail'";
                            $result = mysqli_query($conn, $existEmail);
                            $numExists = mysqli_num_rows($result);
                            if($numExists > 0){
                                $showError = "Email Already exists";
                            }else{
                                $sql = "INSERT INTO `mail_data`(`mail_of`,`mail`) VALUES('$mail_of', '$mail')";
                                $result1 = mysqli_query($conn, $sql);
                                if($result1){
                                    $showAlert = true;
                                }else{
                                    $showError = "Error to add email";
                                }
                            }
                        }
                    }
                    ?>
                    <?php
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your email added successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if ($showError) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> ' . $showError . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        ?>
                    <div class="border p-3 rounded">
                        <form method="post" class="row g-4" enctype="multipart/form-data">
                            <div class="col-6">
                                <label class="form-label">Mail of</label>
                                <input type="text" class="form-control" name="mail-of" placeholder="Enter name" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mail</label>
                                <input class="form-control" placeholder="Enter mail" name="mail" type="email" required>
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