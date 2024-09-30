<?php session_start(); ?>
<?php

require_once "./controllers/QuestionController.php";

$userId = $_SESSION['user']['id'];

$questions = showQuestionsByUser($userId);
$title = "My questions | QA";
require "./views/user_questions.view.php";