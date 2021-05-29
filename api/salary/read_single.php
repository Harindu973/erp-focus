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

  // Get post
  $salary->read_single();

  // Create array
  $salary_arr = array(
    'salaryValue' => $salary->salaryValue,
    'salaryDate' => $salary->salaryDate
  );

  // Make JSON
  print_r(json_encode($salary_arr));
