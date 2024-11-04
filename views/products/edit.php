<?php 
  include_once "../../app/config.php";
  include_once '../../app/ProductController.php';

  $ProductController = new ProductController();
  $link = $_SERVER['REQUEST_URI'];
  $link_array = explode('/', $link);
  $slug = end($link_array);
  $product = $ProductController->getBySlug($slug);

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
                  <li class="breadcrumb-item" aria-current="page">Products</li>
                </ul>
              </div>
              <div class="col-md-12">
                <div class="page-header-title">
                  <h2 class="mb-0">Editar el Producto</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page TTT ] start -->
          <form method="POST" action="../api-products" enctype="multipart/form-data">
            <div class="card">
                <div class="row">
                    <div class="col-3">
                        <div id="carouselExampleIndicators" class="carousel slide">
                            <div class="carousel-indicators">
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img src="<?= $product['cover'] ?>" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="imagefon.jpg" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="imagefon.jpg" class="d-block w-100" alt="...">
                              </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                          <div class="mb-3">
                            <h5 class="card-title">
                              <label for="edit_name" class="form-label">Nombre del Producto</label>
                              <input type="text" class="form-control" value="<?= $product['name'] ?>" id="edit_name" name="name" required/>
                            </h5>
                          </div>
                          <div class="mb-3">
                            <h5 class="card-text">
                              <label for="edit_slug" class="form-label">Slug del Producto</label>
                              <input type="text" class="form-control" value="<?= $product['slug'] ?>" id="edit_slug" name="slug" required/>
                            </h5>
                          </div>
                          <div class="mb-3">
                            <h5 class="card-text">
                              <label for="edit_description" class="form-label">Descripción del Producto</label>
                              <textarea class="form-control" id="edit_description" name="description" required><?= $product['description'] ?></textarea>
                            </h5>
                          </div>  
                          <div class="mb-3">
                            <h5 class="card-text">
                              <label for="edit_features" class="form-label">Caracteristicas del Producto</label>
                              <textarea class="form-control" id="edit_features" name="features" required><?= $product['features'] ?></textarea>
                            </h5>
                            </div>  
                            <div class="mb-3">
                              <h5> Precio: $<?= $product['presentations'][0]['price'][0]['amount'] ?></h5>
                            </div>
                            <div class="mb-3">
                              <h5 class="card-text">
                              <label for="edit_brand" class="form-label">Marca:</label>
                                <select class="form-control" name="brand_id" id="edit_brand" required>
                                      <?php
                                        $brands = $ProductController->get_Brands();
                                        foreach ($brands as $brand) {
                                            $selected = $brand['id'] == $product['brand']['id'] ? 'selected' : '';
                                            echo "<option value=\"{$brand['id']}\" $selected>{$brand['name']}</option>";
                                        }
                                      ?>
                                </select>
                            </div>  
                            <button type="submit" class="btn btn-primary mb-0">Guardar Cambios</button>
                            <input type="hidden" name="action" value="edit_product" />
                            <input type="hidden" id="edit_id" name="id" value="<?= $product['id'] ?>" />
                        </div>
                    </div>
                </div>
              </div>
          </form>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <?php 
      include "../layouts/footer.php";
      ?>
     <?php 
      include "../layouts/scripts.php";
      ?>
    <!-- [Page Specific JS] start -->
    <script>
      // scroll-block
      var tc = document.querySelectorAll('.scroll-block');
      for (var t = 0; t < tc.length; t++) {
        new SimpleBar(tc[t]);
      }
      // quantity start
      function increaseValue(temp) {
        var value = parseInt(document.getElementById(temp).value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById(temp).value = value;
      }
      function decreaseValue(temp) {
        var value = parseInt(document.getElementById(temp).value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? (value = 1) : '';
        value--;
        document.getElementById(temp).value = value;
      }
      // quantity end
    </script>
    <?php 
      include "../layouts/modals.php";
    ?>
  </body>
  <!-- [Body] end -->
</html>
