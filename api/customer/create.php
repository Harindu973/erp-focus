<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


  if ( !isset($_SERVER [ 'PHP_AUTH_USER' ])){
    header ("WWW_Authenticate: Basic realm=\"Private Area\"");
    header ("HTTP/1.0 401 Unauthorized");
    print "Sorry, You need proper credintials";
    exit;
  }else{
    if(($_SERVER['PHP_AUTH_USER'] == "admin") && ($_SERVER['PHP_AUTH_PW'] == "admin@@321")){

      include_once '../../config/Database.php';
      include_once '../../models/Customer.php';
    
      // Instantiate DB & connect
      $database = new Database();
      $db = $database->connect();
    
      // Instantiate blog post object
      $customer = new Customer($db);
    
      // Get raw posted data
      $data = json_decode(file_get_contents("php://input"));
    
      $customer->customer_id = $data->customer_id;
      $customer->customer_name = $data->customer_name;
      $customer->customer_billing_address = $data->customer_billing_address;
      $customer->customer_billing_post_code = $data->customer_billing_post_code;
      $customer->customer_shipping_address = $data->customer_shipping_address;
      $customer->customer_shipping_post_code = $data->customer_shipping_post_code;
      $customer->customer_tp_no = $data->customer_tp_no;
      $customer->customer_type = $data->customer_type;
    
    
      // Create post
      if($customer->create()) {
        echo json_encode(
          array('message' => 'Customer added')
        );
      } else {
        echo json_encode(
          array('message' => 'Fail to add')
        );
      }
    }else{
      header ("WWW_Authenticate: Basic realm=\"Private Area\"");
      header ("HTTP/1.0 401 Unauthorized");
      print "Sorry, You need proper credintials";
    }
  }
