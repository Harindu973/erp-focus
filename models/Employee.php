<?php 
  class Employee {
    // DB stuff
    private $conn;
    private $table = 'employee';

    // Post Properties
    public $id;
    public $name;
    public $dob;
    public $designation;
    public $gender;
    public $email;
    public $phone;

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

      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  //   // Get Single Post
  //   public function read_single() {
  //         // Create query
  //         $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
  //                                   FROM ' . $this->table . ' p
  //                                   LEFT JOIN
  //                                     categories c ON p.category_id = c.id
  //                                   WHERE
  //                                     p.id = ?
  //                                   LIMIT 0,1';

  //         // Prepare statement
  //         $stmt = $this->conn->prepare($query);

  //         // Bind ID
  //         $stmt->bindParam(1, $this->id);

  //         // Execute query
  //         $stmt->execute();

  //         $row = $stmt->fetch(PDO::FETCH_ASSOC);

  //         // Set properties
  //         $this->title = $row['title'];
  //         $this->body = $row['body'];
  //         $this->author = $row['author'];
  //         $this->category_id = $row['category_id'];
  //         $this->category_name = $row['category_name'];
  //   }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, empId = :empId, nic = :nic, dob = :dob, designation = :designation, gender = :gender, email = :email, phone = :phone';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->empId = htmlspecialchars(strip_tags($this->empId));
          $this->nic = htmlspecialchars(strip_tags($this->nic));
          $this->dob = htmlspecialchars(strip_tags($this->dob));
          $this->designation = htmlspecialchars(strip_tags($this->designation));
          $this->gender = htmlspecialchars(strip_tags($this->gender));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->phone = htmlspecialchars(strip_tags($this->phone));

          // Bind data
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':empId', $this->empId);
          $stmt->bindParam(':nic', $this->nic);
          $stmt->bindParam(':dob', $this->dob);
          $stmt->bindParam(':designation', $this->designation);
          $stmt->bindParam(':gender', $this->gender);
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':phone', $this->phone);

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