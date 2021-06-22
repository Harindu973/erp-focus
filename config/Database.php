<?php 

  class Database {
     // DB Params
    //private $host = '10.52.0.4';
    private $host = '139.162.33.5';
    private $db_name = 'cosweb';
    private $username = 'icp_chamara';
    private $password = 'chamara@1234';
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