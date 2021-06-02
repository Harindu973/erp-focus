<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Leave.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $leave = new Leave($db);

  // Blog post query
  $result = $leave->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $leave_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $leave_item = array(
        'leaveId' => $leaveId,
        'empId' => $empId,
        'leaveType' => $leaveType,
        'leaveDesc' => $leaveDesc,
        'leaveDate' => $leaveDate,
        'leaveTime' => $leaveTime,
        'status' => $status
      );

      // Push to "data"
      array_push($leave_arr, $leave_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($leave_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
