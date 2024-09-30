<?php

require_once 'models/Answer.php';

function checkeIfLiked($answerId, $userId)
{
    $answer = new Answer();
    $result = $answer->hasUserLiked($answerId, $userId);
    return $result;
}

function toggleLike($answerId)
{
    $userId = $_SESSION['user']['id']; // Logged-in user ID
    $answer = new Answer();

    if ($answer->hasUserLiked($answerId, $userId)) {
        // If user already liked the answer, remove the like
        $answer->removeLike($answerId, $userId);
        $_SESSION['flash_message'] = "You have unliked the answer.";
    } else {
        // If user hasn't liked the answer, add the like
        $answer->addLike($answerId, $userId);
        $_SESSION['flash_message'] = "You have liked the answer.";
    }

    // Redirect back to the question detail page
    header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect to the previous page
    exit();
}

function checkLikeCount($answerId): int
{
    $answer = new Answer();
    $count = $answer->getLikeCount($answerId);
    return $count;
}