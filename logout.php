<?php
session_start();

// Destroy the session and redirect to the login page
session_destroy();

// Optionally, you can unset specific session variables if you want to keep some session data intact
// unset($_SESSION['user']);

header('Location: login.php');
exit();
