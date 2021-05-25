<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Employee.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $employee = new Employee($db);

  // Blog post query
  $result = $employee->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $employees_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $employee_item = array(
        'id' => $id,
        'empId' => $empId,
        'name' => $name,
        'nic' => $nic,
        'dob' => $dob,
        'designation' => $designation,
        'gender' => $gender,
        'email' => $email,
        'phone' => $phone
      );

      // Push to "data"
      array_push($employees_arr, $employee_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($employees_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
