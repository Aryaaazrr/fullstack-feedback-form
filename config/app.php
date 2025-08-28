<?php
class Database
{
  private $dbFile;
  public $conn;

  public function __construct() {
      $this->dbFile = __DIR__ . '/database/imago_feedback_form.db';
      
      try {
          if (!is_dir(dirname($this->dbFile))) {
              mkdir(dirname($this->dbFile), 0777, true);
          }

          $this->conn = new PDO("sqlite:" . $this->dbFile);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $this->conn->exec("
              CREATE TABLE IF NOT EXISTS feedback (
                  id INTEGER PRIMARY KEY AUTOINCREMENT,
                  name TEXT NOT NULL,
                  email TEXT NOT NULL,
                  comments TEXT NOT NULL,
                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
              )
          ");
      } catch (PDOException $e) {
          die('Connection failed: ' . $e->getMessage());
      }
  }

  // JSON Format Converter Function
  public function message($status, $content)
  {
    echo json_encode(['status' => $status, 'message' => $content]);
  }
}

$db = new Database();