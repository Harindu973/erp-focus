<?php 
  class Database {
    // DB Params
    private $host = 'us-cdbr-east-03.cleardb.com';
    private $db_name = 'heroku_e60a83519a7bbe7';
    private $username = 'b894d03d634289';
    private $password = 'edb7d53b';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }