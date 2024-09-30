<?php
require "./controllers/CategoryController.php";
require "./controllers/QuestionController.php";

// Get all categories or an empty array if none exist
$all_categories = get_categories();  // No need for '|| []'
$all_questions = showQuestions();
$title ="Home | QA";

require "./views/home.view.php";
