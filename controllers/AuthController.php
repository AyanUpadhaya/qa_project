<?php

require_once 'models/User.php';
session_start();
function login($username, $password)
{
    $user = new User();
    $userData = $user->loginUser($username, password: $password);

    if ($userData) {
        // Set session variables to keep user logged in
        $_SESSION['user'] = [
            'id' => $userData['id'],
            'username' => $userData['username'],
            'email' => $userData['email']
        ];

        // Check if a referrer is stored in the session (i.e., the page they came from)
        if (isset($_SESSION['referrer'])) {
            $redirectUrl = $_SESSION['referrer'];
            unset($_SESSION['referrer']); // Clear the referrer after use
            header('Location: ' . $redirectUrl);
        } else {
            // Redirect to dashboard if no referrer is set
            header('Location: dashboard.php');
        }
        exit();
    } else {
        // Set flash message
        $_SESSION['flash_message'] = "Invalid credentials";
        header("Location: " . $_SERVER['HTTP_REFERER']); // Redirect to the previous page
        exit();
    }
}

function register($username, $email, $password)
{
    $user = new User();
    if ($user->registerUser($username, $email, $password)) {
        // Redirect to login
        $_SESSION['flash_message'] = "Registration Successfully";
        header('Location: login.php');
        exit();
    } 
}

function logout()
{
    // Destroy session and redirect to login
    session_destroy();
    header('Location: /login');
    exit();
}



