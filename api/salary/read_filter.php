<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Salary.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $salary = new Salary($db);

  // Get ID
  $salary->empId = isset($_GET['empId']) ? $_GET['empId'] : die();

  // Blog post query
  $result = $salary->read_filter();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $salary_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $salary_item = array(
        'salaryId' => $salaryId,
        'empId' => $empId,
        'salaryValue' => $salaryValue,
        'salaryDate' => $salaryDate,
      );

      // Push to "data"
      array_push($salary_arr, $salary_item);
      // array_push($posts_arr['data'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($salary_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }
