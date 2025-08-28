<?php
include_once '../config/app.php';
include_once 'feedback.php';

$data = new Feedback;
header('Content-Type: application/json');

if (isset($_GET['action']) && $_GET['action'] == 'load-feedback') {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $rawInput = file_get_contents("php://input");
        if (!empty($rawInput)) {
            http_response_code(400); 
            return $data->message(false, 'Bad Request');
        }

        $feedbacks = $data->getFeedback();
        return $feedbacks;
    } else {
        http_response_code(405); 
        return $data->message(false, 'Method not allowed');
    }
} elseif (isset($_GET['action']) && $_GET['action'] === 'post-feedback') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents("php://input"), true);
        if (!$input) {
            $input = $_POST;
        }

        $name = trim($input['name'] ?? '');
        $email = trim($input['email'] ?? '');
        $comments = trim($input['comments'] ?? '');

        if (empty($name) || empty($email) || empty($comments)) {
            http_response_code(422);
            return $data->message(false, "Semua field wajib diisi");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(422);
            return $data->message(false,"Email tidak valid");
            exit;
        }

        $result = $data->postFeedback($name, $email, $comments);        
        return $result;
    } else {
        http_response_code(405); 
        return $data->message(false, 'Method not allowed');
    }
} else {
    http_response_code(400); 
    return $data->message(false, 'Invalid action');
}