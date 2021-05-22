<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Leave.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $leave = new Leave($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));


  $leave->empId = $data->empId;
  $leave->leaveType = $data->leaveType;
  $leave->leaveDesc = $data->leaveDesc;
  $leave->leaveDate = $data->leaveDate;
  $leave->leaveTime = $data->leaveTime;


  // Create post
  if($leave->create()) {
    echo json_encode(
      array('message' => 'Leave Request sent!')
    );
  } else {
    echo json_encode(
      array('message' => 'Send Fail')
    );
  }

