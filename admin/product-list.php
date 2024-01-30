<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<?php include 'helper/dbconnect.php';
    include 'helper.php'
?>

<main class="page-content">
    <?php 
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        
    ?>
    <div class="row row-cols-1 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-3">
        <?php  while($row = mysqli_fetch_assoc($result)){
            // echo $row['product_img'];
            $single_img = image_parse($row['product_img']);
            // $multiple_img = image_parse($row['other_images']);
            
            // print_r($multiple_img);
            ?>
        <div class="col">
            <div class="card border shadow-none mb-0">
                <div class="card-body text-center">
                    <img src="upload/<?php echo $single_img[0]; ?>" class="img-fluid mb-3" alt="">
                    <h6 class="product-title"><?php echo $row['product_name']?></h6>
                    <p class="product-price fs-5 mb-1"><span>$<?php echo $row['price']?></span></p>
                    <div class="rating mb-0">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star text-warning"></i>
                    </div>
                    <small>74 Reviews</small>
                    <div class="actions d-flex align-items-center justify-content-center gap-2 mt-3">
                        <a href="edit-product.php?product_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil-fill"></i> Edit</a>
                        <a href="delete-product.php?product_id=<?php echo $row['id']; ?>class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
    <?php }?>
</main>

<?php include 'footer.php' ?>

?v=<?php echo  time() ?>