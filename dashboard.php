<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
require "./controllers/QuestionController.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $user_id = $_SESSION['user']['id'];  // Assuming the user is logged in and we have a session

    addQuestion($title, $description, $category_id, $user_id);
}

$title = "Dashboard | QA";
require "./views/dashboard.view.php";