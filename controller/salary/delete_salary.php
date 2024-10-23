<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../../database/db_helper.php";
$salary_id  = $_GET["id"];
$employee = deleteSalaryById($salary_id); // Lấy thông tin nhân viên từ DB
echo $salary_id; 
?>