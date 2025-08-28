<?php
include_once '../config/app.php';

class Feedback extends Database 
{
    public function getFeedback() 
    {
        try {
            $sql = "SELECT * FROM feedback ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $this->message('success', $feedbacks);
        } catch (Exception $e) {
            return $this->message('error', $e->getMessage());
        }
    }
    
    public function postFeedback($name, $email, $comments) 
    {
        try {
            $sql = "INSERT INTO feedback (name, email, comments) 
                    VALUES (:name, :email, :comments)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':comments' => $comments
            ]);
            
            return $this->message('success', "Feedback berhasil disimpan");
        } catch (Exception $e) {
            return $this->message('error', $e->getMessage());
        }
    }
}