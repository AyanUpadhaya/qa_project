<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    $_SESSION['flash_message'] = "You need to log in to delete answers.";
    header("Location: login.php");
    exit();
}

require_once './models/Answer.php';

$answerId = $_GET['id'];
$userId = $_SESSION['user']['id'];

// Instantiate the Answer model
$answerModel = new Answer();

// Check if the answer belongs to the logged-in user
if ($answerModel->isAnswerOwner($answerId, $userId)) {
    // Proceed to delete the answer
    if ($answerModel->deleteAnswer($answerId)) {
        $_SESSION['flash_message'] = "Answer deleted successfully.";
    } else {
        $_SESSION['flash_message'] = "Error deleting the answer.";
    }
} else {
    $_SESSION['flash_message'] = "You are not authorized to delete this answer.";
}

// Redirect back to the question detail page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();