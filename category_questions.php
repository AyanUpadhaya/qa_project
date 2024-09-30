<?php

require_once "./controllers/QuestionController.php";

$categoryId = $_GET['category_id']; // Assuming category_id is passed via URL as a GET parameter
$questions = showQuestionsByCategory($categoryId);

$title = "Category Question | QA";

require "./views/category_questions.view.php";