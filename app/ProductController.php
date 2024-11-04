<?php

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'create_product':
            session_start();
            $nombre = $_POST['name'];
            $slug = $_POST['slug'];
            $description = $_POST['description'];
            $features = $_POST['features'];
            $brand_id = $_POST['brands'];
            $cover = $_FILES['cover'];

            $productController = new ProductController();
            $productController->createProduct($nombre, $slug, $description, $features,  $brand_id, $cover);
            break;
        case 'edit_product':
            $nombre = $_POST["name"];
            $slug = $_POST["slug"];
            $description = $_POST["description"];
            $features = $_POST["features"];
            $id = $_POST["id"];
            $brand_id = $_POST["brand_id"];

            $productController = new ProductController();
            $productController->edit_Product($nombre, $slug, $description, $features, $id, $brand_id);

            break;
        case 'remove_product':
            $id = $_POST["id"];
            session_start();
            $productController = new ProductController();
            $productController->remove_Product($id);
            break;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'get_product') {
    $slug = $_GET['slug'];
    $productController = new ProductController();
    $product = $productController->getBySlug($slug);
    echo json_encode($product);
    exit();
}


class ProductController {

    public function products(){
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['user_data']->token
          ),
        ));
  
        $response = curl_exec($curl);
  
        curl_close($curl);
        $responseData = json_decode($response, true);
  
        if (isset($responseData['data'])) {
          return $responseData['data'];
        } else {
          return [];
        }
  
  
      }
  
      public function getBySlug($slug){
  
        $curl = curl_init();
  
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/slug/' . $slug,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['user_data']->token
          ),
        ));
  
        $response = curl_exec($curl);
  
        curl_close($curl);
        #echo $response;
  
        $productData = json_decode($response, true);

        if (isset($productData['data'])) {
            $product = $productData['data'];

            $brand = $this->get_especific_Brand($product['brand_id']);
            $product['brand_name'] = $brand['name'] ?? 'Ninguna';

            return $product;
        } else {
            return null;
        }

  
      }

    public function createProduct($nombre, $slug, $description, $features, $brand_id, $cover) {
        
        $curl = curl_init();
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $cover = $_FILES['cover']['tmp_name'];
            $cover_img = $_FILES['cover']['name'];
            $file = new CURLFILE($cover, mime_content_type($cover), $cover_img);
        } else {
            echo "Error: No se ha subido el archivo de imagen.";
            return;
        }
      

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('name' => $nombre,
                                    'slug' => $slug,
                                    'description' => $description,
                                    'brand_id' => $brand_id,
                                    'features' => $features,
                                    'cover'=> $file),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$_SESSION['user_data']->token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $responseData = json_decode($response, true);

        if (isset($responseData['code']) && $responseData['code'] === 4) {
            header("Location: products");
            exit();
        } else {
            echo "<script>alert('Algo está mal :v');</script>";
        }
        
    }

    public function edit_Product($nombre, $slug, $description, $features, $id, $brand_id){
      $curl = curl_init();

      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_POSTFIELDS => http_build_query(array(
          'name' => $nombre,
          'slug' => $slug,
          'description' => $description,
          'features' => $features,
          'id' => $id,
          'brand_id' => $brand_id,
      )),
      CURLOPT_HTTPHEADER => array(
          'Content-Type: application/x-www-form-urlencoded',
          'Authorization: Bearer '.$_SESSION['user_data']->token
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      
      $response = json_decode($response, true);

      if(isset($response) && $response['code'] == 4){
          header("Location: ../products");
      } else {
          echo "<script>alert('Algo salio mal al editar pa');</script>";
      }
  }
  public function remove_Product($id){
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/products/' . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer '.$_SESSION['user_data']->token
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      
      $response = json_decode($response, true);

      if(isset($response) && $response['code'] == 2){
          header("Location: products");
      } else {
          echo "<script>alert('Algo salio mal al borrar pa');</script>";
      }
  }

  public function get_Brands(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer '.$_SESSION['user_data']->token
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response, true);
    return $response['data'];
  }

  public function get_especific_Brand($brand_id) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://crud.jonathansoto.mx/api/brands/' . $brand_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $_SESSION['user_data']->token
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return json_decode($response, true)['data'] ?? null;
  }
}

?>