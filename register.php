<?php require "./controllers/AuthController.php" ;?>
<?php
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($username !== "" && $email!=="" && $password !== ""){
        register($username,$email,$password);
    }
}
$title = "Register | QA";
require "views/register.view.php";