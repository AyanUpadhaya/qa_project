<?php
// models/User.php
require_once 'config/database.php';

class User{
    private $db;

    public function __construct(){
        // Initialize database connection
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    public function registerUser($username, $email, $password)
    {
        // Check if the email already exists
        $checkStmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Email already exists, return false or handle accordingly
            $_SESSION['flash_message'] = "Email already registered.";
            return false;
        } else {
            // Proceed with registration if email doesn't exist
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $statement = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $statement->bind_param("sss", $username, $email, $hashedPassword);

            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function loginUser($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data as array
        } else {
            return false;
        }
    }

    public function __destruct()
    {
        $this->db->close();
    }
}