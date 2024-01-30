<aside class="sidebar-wrapper">
  <div class="iconmenu">
    <div class="nav-toggle-box">
      <div class="nav-toggle-icon"><i class="bi bi-list"></i></div>
    </div>
    <ul class="nav nav-pills flex-column">
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Category">
        <button class="nav-link " data-bs-toggle="pill" data-bs-target="#pills-application" type="button"><i class="bi bi-grid-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="eCommerce" title="Products">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-ecommerce" type="button"><i class="bi bi-bag-check-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="eCommerce" title="meta">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-icon" type="button"><i class="bi bi-cloud-arrow-down-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="eCommerce" title="email">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-form" type="button"><i class="bi bi-envelope-fill"></i></button>
      </li>
      <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="eCommerce" title="media">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-media" type="button"><i class="bi bi-card-image"></i></button>
      </li>

    </ul>
  </div>
  <div class="textmenu">
    <div class="brand-logo">
      <img src="assets/images/brand-logo-2.png" width="140" alt="" />

    </div>

    <div class="tab-content">
      <div class="tab-pane fade " id="pills-application">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Categories</h5>
            </div>
            <small class="mb-0">Some products content</small>
          </div>
          <a href="add-category.php" class="list-group-item"><i class="bi bi-archive"></i>Add Categories</a>
          <a href="list-category.php" class="list-group-item"><i class="bi bi-check2-square"></i>Category List</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-ecommerce" role="tabpanel">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">eCommerce</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="add-product.php" class="list-group-item"><i class="bi bi-box-seam"></i>Add Product</a>
          <a href="product-list.php" class="list-group-item"><i class="bi bi-card-text"></i>Product details</a>
          <a href="ecommerce-orders.php" class="list-group-item"><i class="bi bi-plus-square"></i>Success Orders</a>
          <a href="unsuccess-orders.php" class="list-group-item"><i class="bi bi-calendar-x"></i>Unsuccess Orders</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-icon" role="tabpanel">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Meta</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="add-meta.php" class="list-group-item"><i class="bi bi-box-seam"></i>Add meta</a>
          <a href="show-meta.php" class="list-group-item"><i class="bi bi-card-text"></i>Meta Detail</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-form" role="tabpanel">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Contact Form</h5>
            </div>
            <small class="mb-0">Some placeholder content</small>
          </div>
          <a href="addEmail.php" class="list-group-item"><i class="bi bi-envelope"></i>Add Email</a>
          <a href="showEmail.php" class="list-group-item"><i class="bi bi-card-text"></i>Show Email</a>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-media" role="tabpanel">
        <div class="list-group list-group-flush">
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-0">Media</h5>
            </div>
          </div>
          <a href="addMedia.php" class="list-group-item"><i class="bi bi-file-earmark-image"></i>Add Media</a>
          <a href="showMedia.php" class="list-group-item"><i class="bi bi-images"></i>Show Media</a>
        </div>
      </div>
    </div>
  </div>
</aside>