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
  include_once '../../models/Sales_invoice_item.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate  object
  $sales_invoice_item = new Sales_invoice_item($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));


  $sales_invoice_item->invoice_number = $data->invoice_number;
  $sales_invoice_item->item_type = $data->item_type;
  $sales_invoice_item->sku = $data->sku;
  $sales_invoice_item->item_name = $data->item_name;
  $sales_invoice_item->reguler_price = $data->reguler_price;
  $sales_invoice_item->sales_price = $data->sales_price;
  $sales_invoice_item->qty = $data->qty;
  $sales_invoice_item->sub_ttl = $data->sub_ttl;
  $sales_invoice_item->shipping_cost = $data->shipping_cost;


  // Create post
  if($sales_invoice_item->create()) {
    echo json_encode(
      array('message' => 'Item Added!')
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

