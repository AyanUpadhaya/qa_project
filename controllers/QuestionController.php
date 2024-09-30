<?php

require_once 'models/Question.php';
require_once 'models/Answer.php';

function addQuestion($title, $description, $category_id, $user_id)
{
    $question = new Question();


    if ($question->addQuestion($title, $description, $category_id, $user_id)) {
        // Redirect with a success message
        $_SESSION['flash_message'] = "Question added successfully!";
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error adding the question.";
    }

}

// Fetch categories for the form dropdown
$question = new Question();
$categories = $question->getCategories();

function showQuestions()
{
    $question = new Question();
    $questions = $question->getAllQuestions();
    return $questions ?: [];

}

function showQuestionDetail($questionId)
{
    $question = new Question();
    $questionDetail = $question->getQuestionById($questionId);
    return $questionDetail;
}
function get_answers_by_question_id($questionId)
{
    $question = new Question();
    $answers = $question->getAnswersByQuestionId($questionId);
    return $answers;

}
function submitAnswer($questionId, $answer, $userId)
{
    $question = new Question();
    if ($question->addAnswer($questionId, $answer, $userId)) {
        // Get the current base URL dynamically
        $baseUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);

        // Set flash message
        $_SESSION['flash_message'] = "Answer submitted successfully!";

        // Redirect dynamically using the base URL
        // header("Location: " . $baseUrl . "/question_detail.php?id=" . $questionId);
        // Redirect back to the question detail page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error submitting the answer.";
    }
}
function showQuestionsByCategory($categoryId)
{
    $question = new Question();
    $questions = $question->getQuestionsByCategory($categoryId);

    return $questions;
}
function showQuestionsByUser($userId)
{
    $question = new Question();
     // Assuming the user is logged in
    $questions = $question->getQuestionsByUserId($userId);

    return $questions;
}
