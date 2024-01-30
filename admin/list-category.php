<?php include 'header.php' ?>
<?php include 'helper/dbconnect.php' ?>
<?php include 'sidebar.php' ?>
<main class="page-content">
  <div class="card">
    <div class="card-header py-3">
      <h6 class="mb-0">Product Category List</h6>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-lg-12 d-flex">
          <div class="card border shadow-none w-100">
            <div class="card-body">
              <div class="table-responsive">
                
                <?php
                $sql = "SELECT * FROM categories order by id";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                ?>

                <table class="table align-middle table-bordered" id="myTable">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($row = mysqli_fetch_assoc($result)){?>
                    <tr>
                      
                      <td><?php echo $row['id']?></td>
                      <td><?php echo $row['category_name']?></td>
                      <td><?php echo $row['category_slug']?></td>
                      <td>
                        <div class="d-flex align-items-center gap-3 fs-6">
                          <a href="edit-category.php?cat_id=<?php echo $row["id"]; ?> " class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                          <a href="delete-category.php?cat_id=<?php echo $row["id"]; ?>" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>

                  </tbody>
                </table>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
    let table = new DataTable('#myTable');
$(document).ready(function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<?php include 'footer.php' ?>