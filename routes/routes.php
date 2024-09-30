<?php require_once "controllers/AuthController.php"; ?>

<?php
$uri = basename(parse_url($_SERVER['REQUEST_URI'])['path']);


if ($uri == 'login' || $uri == 'login/') {
    (new AuthController())->login();
} elseif ($uri == 'register' || $uri == 'register/') {
    (new AuthController())->register();
} else {
    // Default home page
    include 'views/home.php';
}
