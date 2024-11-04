<?php
if (!isset($_SESSION)) {
  session_start();
}

if (!defined('BASE_PATH')) {
  define('BASE_PATH', 'http://localhost/Products_CRUD/');
}

if (!isset($_SESSION['global_token'])) {
  $_SESSION['global_token'] = bin2hex(openssl_random_pseudo_bytes(32));
}