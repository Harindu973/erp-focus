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
  include_once '../../models/Sales_invoice.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $sales_invoice = new Sales_invoice($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));


  $sales_invoice->sales_invoice_no = $data->sales_invoice_no;
  $sales_invoice->sales_location_id = $data->sales_location_id;
  $sales_invoice->invoice_date = $data->invoice_date;
  $sales_invoice->customer_master_id = $data->customer_master_id;

  $sales_invoice->customer_shipping_address = $data->customer_shipping_address;

  $sales_invoice->customer_first_name = $data->customer_first_name;
  $sales_invoice->customer_last_name = $data->customer_last_name;
  $sales_invoice->post_code = $data->post_code;

  $sales_invoice->customer_tp = $data->customer_tp;
  $sales_invoice->customer_email = $data->customer_email;
  $sales_invoice->attention_name = $data->attention_name;

  $sales_invoice->shipping_amount = $data->shipping_amount;
  $sales_invoice->payment_methode = $data->payment_methode;
  $sales_invoice->ttl_amount = $data->ttl_amount;
  $sales_invoice->customer_note = $data->customer_note;

  $sales_invoice->order_status = $data->order_status;
  
  $sales_invoice->active_flag = $data->active_flag;
  $sales_invoice->added_by = $data->added_by;
  $sales_invoice->pos_flag = $data->pos_flag;


// sales_invoice_master_id
// sales_invoice_no
// sales_location_id
// invoice_date
// customer_master_id
// customer_shipping_address
// customer_tp
// customer_email
// attention_name
// shipping_amount
// payment_methode
// ttl_amount
// customer_note
// active_flag
// added_on
// added_by
// pos_flag


  // Create post
  if($sales_invoice->create()) {
    echo json_encode(
      array('message' => 'Invoice added')
    );
  } else {
    echo json_encode(
      array('message' => 'Send Fail')
    );
  }
}else{
  header ("WWW_Authenticate: Basic realm=\"Private Area\"");
  header ("HTTP/1.0 401 Unauthorized");
  print "Sorry, You need proper credintials";
}
}

