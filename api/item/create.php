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
  include_once '../../models/Item.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $item = new Item($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  
  $item->item_id = $data->item_id;
  $item->item_code = $data->item_code;
  $item->item_name = $data->item_name;
  $item->reguler_price = $data->reguler_price;
  $item->sales_price = $data->sales_price;


  // Create post
  if($item->create()) {
    echo json_encode(
      array('message' => 'Item Added')
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