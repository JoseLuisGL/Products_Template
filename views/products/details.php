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
                  <h2 class="mb-0">Detalle del Producto</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page TTT ] start -->
          <div class="card">
                    <div class="card-header">
                      <?= $product['name'] ?>
                    </div>
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
                        <div class="col-6">
                            <div class="card-body">
                                <h5 class="card-title">
                                  <?= $product['name'] ?>
                                </h5>
                                <p class="card-text">
                                  <?= $product['description'] ?>
                                </h4>
                                <p>
                                  <?= $product['features'] ?>
                                </p>
                                <h5> Precio: $<?= $product['presentations'][0]['price'][0]['amount'] ?></h5>
                                <h5> Marca:</h5>
                                <li><?= $product['brand']['name'] ?></li>
                                <h5>Etiquetas:</h5>
                                <ul>
                                    <?php foreach ($product['tags'] as $tag): ?>
                                        <li><?= $tag['name'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <h5>Categorias:</h5>
                                <ul>
                                    <?php foreach ($product['categories'] as $tag): ?>
                                        <li><?= $tag['name'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                              </div>
                        </div>
                    </div>
                  </div>
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
