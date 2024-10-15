<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../database/db_helper.php";
$employee_id  = $_GET["id"];
$employee = deleteEmployeeById($employee_id); // Lấy thông tin nhân viên từ DB
echo $employee_id; 
?>