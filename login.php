<?php require "./controllers/AuthController.php"; ?>
<?php
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username !== "" && $password !== "") {
        login($username, $password);
    } else {
        $_SESSION['flash_message'] = "Invalid credentials";
        header('Location: login.php');
        exit();
    }
}
$title = "Login | QA";
require "views/login.view.php";

