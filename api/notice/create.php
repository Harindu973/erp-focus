<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Notice.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $notice = new Notice($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $notice->title = $data->title;
  $notice->message = $data->message;


  // Create post
  if($notice->create()) {
    echo json_encode(
      array('message' => 'Notice added')
    );
  } else {
    echo json_encode(
      array('message' => 'Fail')
    );
  }

