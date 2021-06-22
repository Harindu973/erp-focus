<?php 
  class Customer {
    // DB stuff
    private $conn;
    private $table = 'customer_master';

    // Post Properties
    public $customer_id;
    public $customer_name;
    public $customer_billing_address;
    public $customer_billing_post_code;
    public $customer_shipping_address;
    public $customer_shipping_post_code;
    public $customer_tp_no;
    public $customer_type;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }



    // Create 
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET customer_id = :customer_id, customer_name = :customer_name, customer_billing_address = :customer_billing_address, customer_billing_post_code = :customer_billing_post_code, customer_shipping_address = :customer_shipping_address, customer_shipping_post_code = :customer_shipping_post_code, customer_tp_no = :customer_tp_no, customer_type = :customer_type, last_updated_date = now() ';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->customer_id = htmlspecialchars(strip_tags($this->customer_id));
          $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
          $this->customer_billing_address = htmlspecialchars(strip_tags($this->customer_billing_address));
          $this->customer_billing_post_code = htmlspecialchars(strip_tags($this->customer_billing_post_code));
          $this->customer_shipping_address = htmlspecialchars(strip_tags($this->customer_shipping_address));
          $this->customer_shipping_post_code = htmlspecialchars(strip_tags($this->customer_shipping_post_code));
          $this->customer_tp_no = htmlspecialchars(strip_tags($this->customer_tp_no));
          $this->customer_type = htmlspecialchars(strip_tags($this->customer_type));

       

          // Bind data
          $stmt->bindParam(':customer_id', $this->customer_id);
          $stmt->bindParam(':customer_name', $this->customer_name);
          $stmt->bindParam(':customer_billing_address', $this->customer_billing_address);
          $stmt->bindParam(':customer_billing_post_code', $this->customer_billing_post_code);
          $stmt->bindParam(':customer_shipping_address', $this->customer_shipping_address);
          $stmt->bindParam(':customer_shipping_post_code', $this->customer_shipping_post_code);
          $stmt->bindParam(':customer_tp_no', $this->customer_tp_no);
          $stmt->bindParam(':customer_type', $this->customer_type);



          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }
  }
?>
    