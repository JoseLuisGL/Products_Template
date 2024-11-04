<?php 
  include_once "../app/config.php";

?>

<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title>Login | Light Able Admin & Dashboard Template</title>
    <?php
    include "layouts/head.php";
    ?>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <div class="auth-main v2">
            <div class="bg-overlay bg-dark"></div>
            <div class="auth-wrapper">
              <div class="auth-sidecontent"> <div class="auth-sidefooter">
        <img src="<?= BASE_PATH ?>assets/images/logo-dark.svg" class="img-brand img-fluid" alt="images" />
        <hr class="mb-3 mt-4" />
        <div class="row">
          <div class="col my-1">
            <p class="m-0">Made with ♥ by Team <a href="https://themeforest.net/user/phoenixcoded" target="_blank"> Phoenixcoded</a></p>
          </div>
          <div class="col-auto my-1">
            <ul class="list-inline footer-link mb-0">
              <li class="list-inline-item"><a href="../index.html">Home</a></li>
              <li class="list-inline-item"><a href="https://pcoded.gitbook.io/light-able/" target="_blank">Documentation</a></li>
              <li class="list-inline-item"><a href="https://phoenixcoded.support-hub.io/" target="_blank">Support</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
        <div class="auth-form">
          <div class="card my-5 mx-3">
            <div class="card-body">
              <h4 class="f-w-500 mb-1">Login with your email</h4>
              <p class="mb-3">Don't have an Account? <a href="register-v2.html" class="link-primary ms-1">Create Account</a></p>
              <div class="mb-3">
                <form method="POST" action="auth">
                      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email Address" />
                    </div>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" id="floatingInput1" placeholder="Password" />
                    </div>
                    <div class="d-flex mt-1 justify-content-between align-items-center">
                      <div class="form-check">
                        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="" />
                        <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                      </div>
                      <a href="forgot-password-v2.html">
                        <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6>
                      </a>
                    </div>
                    <div class="d-grid mt-4">
                      <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <input type="text" hidden name="action" value="access">
                    <input type="text" name="global_token" value=<?= $_SESSION['global_token'] ?> hidden>
                </form>
              <div class="saprator my-3">
                <span>Or continue with</span>
              </div>
              <div class="text-center">
                <ul class="list-inline mx-auto mt-3 mb-0">
                  <li class="list-inline-item">
                    <a href="https://www.facebook.com/" class="avtar avtar-s rounded-circle bg-facebook" target="_blank">
                      <i class="fab fa-facebook-f text-white"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://twitter.com/" class="avtar avtar-s rounded-circle bg-twitter" target="_blank">
                      <i class="fab fa-twitter text-white"></i>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a href="https://myaccount.google.com/" class="avtar avtar-s rounded-circle bg-googleplus" target="_blank">
                      <i class="fab fa-google text-white"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
  </body>
  <!-- [Body] end -->
</html>