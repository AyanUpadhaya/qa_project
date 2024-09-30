<?php

require_once 'config/database.php';

class Question
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function addQuestion($title, $description, $category_id, $user_id)
    {
        $stmt = $this->db->prepare("INSERT INTO questions (title, description, category_id, user_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $title, $description, $category_id, $user_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllQuestions()
    {
        $stmt = $this->db->query("SELECT q.id, q.title, q.description, c.name as category_name, u.username, q.created_at
                                  FROM questions q
                                  JOIN categories c ON q.category_id = c.id
                                  JOIN users u ON q.user_id = u.id
                                  ORDER BY q.created_at DESC");

        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories()
    {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuestionById($id){
        $stmt = $this->db->prepare("SELECT q.id, q.title, q.description, c.name as category_name, u.username,u.id AS user_id, q.created_at 
                                    FROM questions q 
                                    JOIN categories c ON q.category_id = c.id
                                    JOIN users u ON q.user_id = u.id
                                    WHERE q.id = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Fetch all answers for a question
    public function getAnswersByQuestionId($questionId)
    {
        $stmt = $this->db->prepare("SELECT a.id, a.answer, u.id AS user_id, u.username, a.likes, a.created_at 
                                FROM answers a
                                JOIN users u ON a.user_id = u.id
                                WHERE a.question_id = ?
                                ORDER BY a.created_at DESC");
        $stmt->bind_param("i", $questionId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Add an answer to a question
    public function addAnswer($questionId, $answer, $userId)
    {
        $stmt = $this->db->prepare("INSERT INTO answers (question_id, answer, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $questionId, $answer, $userId);
        return $stmt->execute();
    }

    public function getQuestionsByCategory($categoryId)
    {
        $stmt = $this->db->prepare("SELECT * FROM questions WHERE category_id = ?");
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch all questions
        $questions = $result->fetch_all(MYSQLI_ASSOC);

        return $questions;
    }

    public function getQuestionsByUserId($userId){
        $stmt = $this->db->prepare("SELECT * FROM questions WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        // Fetch all questions
        $questions = $result->fetch_all(MYSQLI_ASSOC);

        return $questions;
    }

    public function deleteQuestion($questionId)
    {
        // First, delete all answers associated with the question
        $stmt = $this->db->prepare("DELETE FROM answers WHERE question_id = ?");
        $stmt->bind_param("i", $questionId);
        $stmt->execute();

        // Then, delete the question itself
        $stmt = $this->db->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->bind_param("i", $questionId);
        return $stmt->execute();
    }

    public function __destruct()
    {
        $this->db->close();
    }
}
