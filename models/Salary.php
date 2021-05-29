<?php 
  class Salary {
    // DB stuff
    private $conn;
    private $table = 'salary';

    // Post Properties
    public $salaryId;
    public $empId;
    public $salaryValue;
    public $salaryDate;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query

      // $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
      //                           FROM ' . $this->table . ' p
      //                           LEFT JOIN
      //                             categories c ON p.category_id = c.id
      //                           ORDER BY
      //                             p.created_at DESC';

      $query = 'SELECT * FROM salary ORDER BY salaryId DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

     // Get Posts
     public function read_filter() {
      // Create query

      // $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
      //                           FROM ' . $this->table . ' p
      //                           LEFT JOIN
      //                             categories c ON p.category_id = c.id
      //                           ORDER BY
      //                             p.created_at DESC';

      $query = 'SELECT * FROM ' . $this->table . ' WHERE empId = ?';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->empId);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' WHERE empId = ?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->empId);

      // Execute query
      $stmt->execute();

      return $stmt;
     }

  //   // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET empId = :empId, salaryValue = :salaryValue, salaryDate = :salaryDate';

          // Prepare statement
          $stmt = $this->conn->prepare($query);
          
          // Clean data
          $this->empId = htmlspecialchars(strip_tags($this->empId));
          $this->salaryValue = htmlspecialchars(strip_tags($this->salaryValue));
          $this->salaryDate = htmlspecialchars(strip_tags($this->salaryDate));

          // Bind data
          $stmt->bindParam(':empId', $this->empId);
          $stmt->bindParam(':salaryValue', $this->salaryValue);
          $stmt->bindParam(':salaryDate', $this->salaryDate);

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