<?php 
  class Sales_invoice {
    // DB stuff
    private $conn;
    private $table = 'sales_invoice_master';

    // Post Properties
    public $sales_invoice_no;
    public $sales_location_id;
    public $invoice_date;
    public $customer_master_id;
    public $customer_shipping_address;

    public $customer_first_name;
    public $customer_last_name;
    public $post_code;

    public $customer_tp;
    public $customer_email;

    public $attention_name;
    public $shipping_amount;
    public $payment_methode;
    public $ttl_amount;
    public $customer_note;

    public $order_status;

    public $active_flag;
    public $added_by;
    public $pos_flag;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

   
    // Create Leave
    public function create() {

          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET sales_invoice_no = :sales_invoice_no, sales_location_id = :sales_location_id, invoice_date = :invoice_date, customer_master_id = :customer_master_id, customer_shipping_address = :customer_shipping_address, customer_first_name = :customer_first_name, customer_last_name = :customer_last_name, post_code = :post_code, customer_tp = :customer_tp, customer_email = :customer_email, attention_name = :attention_name, shipping_amount = :shipping_amount, payment_methode = :payment_methode, ttl_amount = :ttl_amount, customer_note = :customer_note, order_status = :order_status, active_flag = :active_flag, added_on = now(), added_by = :added_by, pos_flag = :pos_flag';

          //

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->sales_invoice_no = htmlspecialchars(strip_tags($this->sales_invoice_no));
          $this->sales_location_id = htmlspecialchars(strip_tags($this->sales_location_id));
          $this->invoice_date = htmlspecialchars(strip_tags($this->invoice_date));

          $this->customer_master_id = htmlspecialchars(strip_tags($this->customer_master_id));
          $this->customer_shipping_address = htmlspecialchars(strip_tags($this->customer_shipping_address));
          $this->customer_first_name = htmlspecialchars(strip_tags($this->customer_first_name));
          $this->customer_last_name = htmlspecialchars(strip_tags($this->customer_last_name));
          $this->post_code = htmlspecialchars(strip_tags($this->post_code));

          $this->customer_tp = htmlspecialchars(strip_tags($this->customer_tp));
          $this->customer_email = htmlspecialchars(strip_tags($this->customer_email));

          $this->attention_name = htmlspecialchars(strip_tags($this->attention_name));
          $this->shipping_amount = htmlspecialchars(strip_tags($this->shipping_amount));
          $this->payment_methode = htmlspecialchars(strip_tags($this->payment_methode));
          $this->ttl_amount = htmlspecialchars(strip_tags($this->ttl_amount));

          $this->customer_note = htmlspecialchars(strip_tags($this->customer_note));
          $this->order_status = htmlspecialchars(strip_tags($this->order_status));
    
          $this->active_flag = htmlspecialchars(strip_tags($this->active_flag));
          $this->added_by = htmlspecialchars(strip_tags($this->added_by));
          $this->pos_flag = htmlspecialchars(strip_tags($this->pos_flag));

          // Bind data
          $stmt->bindParam(':sales_invoice_no', $this->sales_invoice_no);
          $stmt->bindParam(':sales_location_id', $this->sales_location_id);
          $stmt->bindParam(':invoice_date', $this->invoice_date);

          $stmt->bindParam(':customer_master_id', $this->customer_master_id);
          $stmt->bindParam(':customer_shipping_address', $this->customer_shipping_address);
          $stmt->bindParam(':customer_first_name', $this->customer_first_name);
          $stmt->bindParam(':customer_last_name', $this->customer_last_name);
          $stmt->bindParam(':post_code', $this->post_code);
 
          $stmt->bindParam(':customer_tp', $this->customer_tp);
          $stmt->bindParam(':customer_email', $this->customer_email);

          $stmt->bindParam(':attention_name', $this->attention_name);
          $stmt->bindParam(':shipping_amount', $this->shipping_amount);
          $stmt->bindParam(':payment_methode', $this->payment_methode);
          $stmt->bindParam(':ttl_amount', $this->ttl_amount);

          $stmt->bindParam(':customer_note', $this->customer_note);
          $stmt->bindParam(':order_status', $this->order_status);
  
          $stmt->bindParam(':active_flag', $this->active_flag);
          $stmt->bindParam(':added_by', $this->added_by);
          $stmt->bindParam(':pos_flag', $this->pos_flag);

          // Execute query
          if($stmt->execute()) {
            return true;
          }




      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

  }