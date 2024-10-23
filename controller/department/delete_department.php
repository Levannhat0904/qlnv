<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../../database/db_helper.php";
$department_id  = $_GET["id"];
$employee = deleteDepartmentById($department_id); // Lấy thông tin nhân viên từ DB
echo $department_id; 
?>