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

  // Get ID
  $employee->email = isset($_GET['email']) ? $_GET['email'] : die();

  // Get post
  $employee->read_single();

  // Create array
  $employee_arr = array(
    'empId' => $employee->empId,
  );

  // Make JSON
  print_r(json_encode($employee_arr));