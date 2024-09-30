<?php

require './controllers/QuestionController.php';
require './controllers/AnswerController.php';

session_start();
// Check if the user is not logged in
if (!isset($_SESSION['user'])) {
    // Store the current page URL (question detail page) in the session
    $_SESSION['referrer'] = $_SERVER['REQUEST_URI'];

    // Redirect to login page
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $questionId = $_GET['id'];
    $questionDetail = showQuestionDetail($questionId);
    $answers = get_answers_by_question_id(questionId: $questionId);
} else {
    // Handle the case where no question ID is provided
    echo "No question found!";
    exit;
}

$title = "Question Detail | QA";

// Now, render the question detail view here
include 'views/question_detail.view.php';