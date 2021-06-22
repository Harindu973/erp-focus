<?php 
  class Item {
    // DB stuff
    private $conn;
    private $table = 'item_master';

    // Post Properties
    public $item_id;
    public $item_code;
    public $item_name;
    public $reguler_price;
    public $sales_price;


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

      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id ASC';
      
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
          $query = 'INSERT INTO ' . $this->table . ' SET item_id = :item_id, item_code = :item_code, item_name = :item_name, reguler_price = :reguler_price, sales_price = :sales_price, last_updated_date = now()';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->item_id = htmlspecialchars(strip_tags($this->item_id));
          $this->item_code = htmlspecialchars(strip_tags($this->item_code));
          $this->item_name = htmlspecialchars(strip_tags($this->item_name));
          $this->reguler_price = htmlspecialchars(strip_tags($this->reguler_price));
          $this->sales_price = htmlspecialchars(strip_tags($this->sales_price));

          // Bind data
          $stmt->bindParam(':item_id', $this->item_id);
          $stmt->bindParam(':item_code', $this->item_code);
          $stmt->bindParam(':item_name', $this->item_name);
          $stmt->bindParam(':reguler_price', $this->reguler_price);
          $stmt->bindParam(':sales_price', $this->sales_price);

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