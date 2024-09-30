<?php
// toggleLike.php

require './controllers/AnswerController.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /qa_project/login.php");
    exit();
}

// Get the action (like/unlike) and answer ID from the URL
$action = isset($_GET['action']) ? $_GET['action'] : null;
$answerId = isset($_GET['answer_id']) ? (int) $_GET['answer_id'] : null;

// Ensure valid parameters are passed
if (!$action || !$answerId) {
    $_SESSION['flash_message'] = "Invalid action or answer.";
    header("Location: /qa_project/index.php"); // Redirect to the homepage if invalid
    exit();
}

// Process the like or unlike action
toggleLike($answerId);

// The `toggleLike` function will redirect back to the same page