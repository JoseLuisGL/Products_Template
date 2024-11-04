<?php 
  include_once "../../app/config.php";
  include_once '../../app/ProductController.php';
  $ProductController = new ProductController();

?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <?php 
      include "../layouts/head.php";
    ?>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">  
    <?php 
      include "../layouts/sidebar.php";
    ?>
    <?php 
      include "../layouts/nav.php";
    ?>
    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col-md-12">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">E-commerce</a></li>
                  <li class="breadcrumb-item" aria-current="page">Add New Product</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Añadir Nuevo Producto</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
        <form method="POST" action="../api-products" enctype="multipart/form-data">   
            <div class="col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h5>Datos del Producto</h5>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <label class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" placeholder="Enter Product Name" id="name" name="name" required/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Slug del Producto</label>
                    <input type="text" class="form-control" placeholder="Enter Product Slug" id="slug" name="slug" required/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Descripción del Producto</label>
                    <textarea class="form-control" placeholder="Enter Product Description" id="description" name="description" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Caracteristicas del Producto</label>
                    <textarea class="form-control" placeholder="Enter Product Features" id="features" name="features" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <select class="form-control" name="brands" id="brands">
                      <?php
                        $brands = $ProductController->get_Brands();
                        foreach ($brands as $brand) {
                          echo "<option value=\"{$brand['id']}\">{$brand['name']}</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="cover" class="form-label">Imagen del Producto</label>
                    <input type="file" class="form-control" id="cover" name="cover" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card">
              <input type="hidden" name="action" value="create_product"/>
              <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
                <div class="card-body text-end btn-page">
                  <button class="btn btn-primary mb-0">Save product</button>
                </div>
              </div>
            </div>
            <!-- [ sample-page ] end -->
          </div>
        </form>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <?php 
      include "../layouts/footer.php";
    ?> 
    <?php 
      include "../layouts/scripts.php";
    ?>
    <?php 
      include "../layouts/modals.php";
    ?>
  </body>
  <!-- [Body] end -->
</html>
