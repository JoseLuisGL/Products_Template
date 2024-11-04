<?php
session_start();

if (!isset($_SESSION['global_token'])) {
    $_SESSION['global_token'] = tokenG(32);
}

function tokenG($leng=10) {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $token = '';

    for ($i = 0; $i < $leng; $i++) {
        $token .= $caracteres[rand(0, 35)];
    }
    return $token;
}

if (isset($_POST['action'])) {
    if (isset($_POST['global_token']) && $_POST['global_token'] === $_SESSION['global_token']) {
        switch ($_POST['action']) {
            case "access":
                $authController = new AuthController();
                $email = $_POST['email'];
                $password = $_POST['password'];
                $authController->login($email, $password);
                break;
            }
    } else {
        header("Location: login?error=invalid_token");
        exit();
    }
}

class AuthController{

    public function login($email=null, $password=null){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://crud.jonathansoto.mx/api/login',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array('email' => $email,'password' => $password), 
          CURLOPT_HTTPHEADER => array( ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        if (isset($response->data->name)) {
          

            $_SESSION['user_data'] = $response->data;
            $_SESSION['user_id'] = $response->data->id;

            header('Location: home');

        }else{

            header('Location: ' . $_SERVER['HTTP_REFERER']);

        } 
        
    }

}



?>