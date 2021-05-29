<?php 
  class Notice {
    // DB stuff
    private $conn;
    private $table = 'notice';

    // Post Properties
    public $id;
    public $title;
    public $message;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query


      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  //   // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT empId FROM ' . $this->table . ' WHERE email = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->email);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->empId = $row['empId'];

    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET title = :title, message = :message';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->message = htmlspecialchars(strip_tags($this->message));
  

          // Bind data
          $stmt->bindParam(':title', $this->title);
          $stmt->bindParam(':message', $this->message);


          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

  //   // Update Post
  //   public function update() {
  //         // Create query
  //         $query = 'UPDATE ' . $this->table . '
  //                               SET title = :title, body = :body, author = :author, category_id = :category_id
  //                               WHERE id = :id';

  //         // Prepare statement
  //         $stmt = $this->conn->prepare($query);

  //         // Clean data
  //         $this->title = htmlspecialchars(strip_tags($this->title));
  //         $this->body = htmlspecialchars(strip_tags($this->body));
  //         $this->author = htmlspecialchars(strip_tags($this->author));
  //         $this->category_id = htmlspecialchars(strip_tags($this->category_id));
  //         $this->id = htmlspecialchars(strip_tags($this->id));

  //         // Bind data
  //         $stmt->bindParam(':title', $this->title);
  //         $stmt->bindParam(':body', $this->body);
  //         $stmt->bindParam(':author', $this->author);
  //         $stmt->bindParam(':category_id', $this->category_id);
  //         $stmt->bindParam(':id', $this->id);

  //         // Execute query
  //         if($stmt->execute()) {
  //           return true;
  //         }

  //         // Print error if something goes wrong
  //         printf("Error: %s.\n", $stmt->error);

  //         return false;
  //   }

  //   // Delete Post
  //   public function delete() {
  //         // Create query
  //         $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

  //         // Prepare statement
  //         $stmt = $this->conn->prepare($query);

  //         // Clean data
  //         $this->id = htmlspecialchars(strip_tags($this->id));

  //         // Bind data
  //         $stmt->bindParam(':id', $this->id);

  //         // Execute query
  //         if($stmt->execute()) {
  //           return true;
  //         }

  //         // Print error if something goes wrong
  //         printf("Error: %s.\n", $stmt->error);

  //         return false;
  //   }
    
 }