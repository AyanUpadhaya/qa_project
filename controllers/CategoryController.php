<?php require "config/database.php" ;?>

<?php
function get_categories()
{
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($db->connect_error) {
        die("Database connection failed: " . $db->connect_error);
    }

    $statement = $db->prepare("SELECT * FROM `categories`");
    $statement->execute();
    $result = $statement->get_result();

    // Fetch all rows as an associative array
    $categories = $result->fetch_all(MYSQLI_ASSOC);  // Fetch all rows

    $db->close();

    // Return the categories, or an empty array if no rows were fetched
    return $categories ?: [];
}
