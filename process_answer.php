<?php
session_start();
require 'controllers/QuestionController.php'; // Include your QuestionController for the functions

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Check if the form has been submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form submission
    $questionId = $_POST['question_id'];
    $answer = $_POST['answer'];
    $userId = $_SESSION['user']['id']; // Assuming the user is logged in

    // Call the function to submit the answer
    submitAnswer($questionId, $answer, $userId);

    // After submitting, redirect back to the question detail page
    // Handle error case (optional)

} else {
    // If this page is accessed directly, redirect to the home page
    header("Location: index.php");
    exit();
}
