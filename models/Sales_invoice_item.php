<?php 
  class Sales_invoice_item {
    // DB stuff
    private $conn;
    private $table = 'sales_invoice_master_item';

    // Post Properties
    public $invoice_number;
    public $item_type;
    public $sku;
    public $item_name;
    public $reguler_price;
    public $sales_price;
    public $qty;
    public $sub_ttl;
    public $shipping_cost;



    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

   
  //   // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET invoice_number = :invoice_number, item_type = :item_type, sku = :sku, item_name = :item_name, reguler_price = :reguler_price, sales_price = :sales_price, qty = :qty, sub_ttl = :sub_ttl, last_updated_date = now(), shipping_cost = :shipping_cost ';

          // Prepare statement
          $stmt = $this->conn->prepare($query);
          
          // Clean data
          $this->invoice_number = htmlspecialchars(strip_tags($this->invoice_number));
          $this->item_type = htmlspecialchars(strip_tags($this->item_type));
          $this->sku = htmlspecialchars(strip_tags($this->sku));
          $this->item_name = htmlspecialchars(strip_tags($this->item_name));
          $this->reguler_price = htmlspecialchars(strip_tags($this->reguler_price));
          $this->sales_price = htmlspecialchars(strip_tags($this->sales_price));
          $this->qty = htmlspecialchars(strip_tags($this->qty));
          $this->sub_ttl = htmlspecialchars(strip_tags($this->sub_ttl));
          $this->shipping_cost = htmlspecialchars(strip_tags($this->shipping_cost));


          // Bind data
          $stmt->bindParam(':invoice_number', $this->invoice_number);
          $stmt->bindParam(':item_type', $this->item_type);
          $stmt->bindParam(':sku', $this->sku);
          $stmt->bindParam(':item_name', $this->item_name);
          $stmt->bindParam(':reguler_price', $this->reguler_price);
          $stmt->bindParam(':sales_price', $this->sales_price);
          $stmt->bindParam(':qty', $this->qty);
          $stmt->bindParam(':sub_ttl', $this->sub_ttl);
          $stmt->bindParam(':shipping_cost', $this->shipping_cost);


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