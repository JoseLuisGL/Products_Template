<?php 
  include_once "../../app/config.php";
  include_once '../../app/ProductController.php';
  $ProductController = new ProductController();

    if (isset($_SESSION['user_id']) && $_SESSION['user_id']!=null) {
        
      $products = $ProductController->products();
      
    }else{

      header('Location: login');
    }

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
                  <h2 class="mb-0">Products</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <a href="<?= BASE_PATH ?>products/create" class="btn btn-primary">+Agregar</a>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                    <div class="card m-1" style="width: 18rem;">
                        <img src="<?= $product['cover'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                        <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                          <div class="flex-grow-1 ms-3">
                            <a href="<?= BASE_PATH ?>products/<?= $product['slug'] ?>" class="btn btn-primary">Detalles</a>
                            <a href="<?= BASE_PATH ?>products/edit/<?= $product['slug'] ?>" class="btn btn-primary edit-btn">Editar</a>
                            <a href="#" onclick="remove(<?= $product['id'] ?>)" class="btn btn-danger">Eliminar</a>
                          </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay mass productoss</p>
                <?php endif; ?>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <form id="delete-form" action="api-products" method="POST">
          <input type="hidden" name="action" value="remove_product" />
          <input type="hidden" id="delete-product-id" name="id" />
        </form>
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
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      function remove(productId){
			swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this imaginary file!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			})
			.then((willDelete) => {
			if (willDelete) {
				swal("Poof! Your imaginary file has been deleted!", {
				icon: "success",
				});
				document.getElementById("delete-product-id").value = productId;
                document.getElementById("delete-form").submit();
			} else {
				
			}
			});
		}
    </script>
   <?php 
      include "../layouts/modals.php";
    ?>
  </body>
  <!-- [Body] end -->
</html>