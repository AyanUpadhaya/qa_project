<?php
session_start();
require_once 'models/Question.php'; // Assuming the Question model handles the database interactions

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['flash_message'] = "You must be logged in to delete a question.";
    header('Location: login.php');
    exit();
}

// Check if the question ID is provided
if (!isset($_GET['id'])) {
    $_SESSION['flash_message'] = "No question ID provided.";
    header('Location: dashboard.php');
    exit();
}

$questionId = $_GET['id'];
$userId = $_SESSION['user']['id']; // Logged-in user ID

// Instantiate the Question model
$question = new Question();

// Get the question to check if the logged-in user is the owner
$questionData = $question->getQuestionById($questionId);

if (!$questionData) {
    $_SESSION['flash_message'] = "Question not found.";
    header('Location: dashboard.php');
    exit();
}

// Check if the logged-in user is the owner of the question
if ($questionData['user_id'] !== $userId) {
    $_SESSION['flash_message'] = "You are not authorized to delete this question.";
    header('Location: dashboard.php');
    exit();
}

// Proceed to delete the question
if ($question->deleteQuestion($questionId)) {
    $_SESSION['flash_message'] = "Question deleted successfully.";
    header("Location:user_questions.php");
    exit();
} else {
    $_SESSION['flash_message'] = "Error deleting question.";
    // Redirect to the dashboard or question list
    header("Location:user_questions.php");
    exit();
}

