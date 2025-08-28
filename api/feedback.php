<?php
include_once '../config/app.php';

class Feedback extends Database 
{    
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