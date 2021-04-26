<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Attendance.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $attendance = new Attendance($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

   //Set ID to update
 // $attendance->name = $data->name;
  $attendance->empId = $data->empId;
  // $attendance->nic = $data->nic;
  // $attendance->dob = $data->dob;
  // $attendance->designation = $data->designation;
  // $attendance->gender = $data->gender;
  // $attendance->email = $data->email;
  // $attendance->phone = $data->phone;

  // Update post
  if($attendance->update()) {
    echo json_encode(
      array('message' => 'Attendance Marked')
    );
  } else {
    echo json_encode(
      array('message' => 'Try Again!')
    );
  }

