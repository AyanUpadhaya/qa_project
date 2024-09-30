<?php
require_once 'config/database.php';

class Answer
{

    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // Fetch whether a user has liked the answer
    // Check if the user already liked the answer
    public function hasUserLiked($answerId, $userId)
    {
        $stmt = $this->db->prepare("SELECT likes FROM answers WHERE id = ?");
        $stmt->bind_param("i", $answerId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        // Decode the likes field into an array
        $likes = json_decode($result['likes'], true);

        // Ensure $likes is an array, otherwise set it as an empty array
        if (!is_array($likes)) {
            $likes = [];
        }

        // Check if the user ID is in the likes array
        return in_array($userId, $likes);
    }

    // Add a like
    public function addLike($answerId, $userId)
    {
        // Fetch the current likes
        $stmt = $this->db->prepare("SELECT likes FROM answers WHERE id = ?");
        $stmt->bind_param("i", $answerId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        // Decode the likes into an array
        $likes = json_decode($result['likes'], true);

        // Ensure $likes is an array, otherwise set it as an empty array
        if (!is_array($likes)) {
            $likes = [];
        }

        // Check if the user has already liked the answer
        if (!in_array($userId, $likes)) {
            // Add the user ID to the likes array
            $likes[] = $userId;
        }

        // Re-encode the likes array as JSON
        $likesJson = json_encode($likes);

        // Update the answer record with the new likes
        $updateStmt = $this->db->prepare("UPDATE answers SET likes = ? WHERE id = ?");
        $updateStmt->bind_param("si", $likesJson, $answerId);
        return $updateStmt->execute();
    }
    // Remove a like
    public function removeLike($answerId, $userId)
    {
        // Fetch the current likes
        $stmt = $this->db->prepare("SELECT likes FROM answers WHERE id = ?");
        $stmt->bind_param("i", $answerId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        // Decode the likes into an array
        $likes = json_decode($result['likes'], true);

        // Ensure $likes is an array, otherwise set it as an empty array
        if (!is_array($likes)) {
            $likes = [];
        }

        // Remove the user from the likes array if they exist
        if (($key = array_search($userId, $likes)) !== false) {
            unset($likes[$key]);

            // Re-index the array and convert it back to JSON
            $likesJson = json_encode(array_values($likes)); // Ensure no gaps in array indices

            // Update the likes field in the database
            $updateStmt = $this->db->prepare("UPDATE answers SET likes = ? WHERE id = ?");
            $updateStmt->bind_param("si", $likesJson, $answerId);
            return $updateStmt->execute();
        }

        // If the user wasn't in the likes array, no action is needed
        return false;
    }


    // Get total likes for an answer
    public function getLikeCount($answerId)
    {
        $stmt = $this->db->prepare("SELECT likes FROM answers WHERE id = ?");
        $stmt->bind_param("i", $answerId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        // Decode the likes field, if null or not a valid array, default to empty array
        $likes =json_decode($result['likes']);

        // Ensure $likes is an array
        if (!is_array($likes)) {
            $likes = [];
        }

        return count($likes);
    }

    // Method to check if the logged-in user is the owner of the answer
    public function isAnswerOwner($answerId, $userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM answers WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $answerId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0; // Return true if the answer exists and belongs to the user
    }

    // Method to delete the answer
    public function deleteAnswer($answerId)
    {
        $stmt = $this->db->prepare("DELETE FROM answers WHERE id = ?");
        $stmt->bind_param("i", $answerId);
        return $stmt->execute();
    }

    public function __destruct()
    {
        $this->db->close();
    }



}