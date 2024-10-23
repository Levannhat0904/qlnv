<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../../database/db_helper.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $employee_id = $_POST['employee_id'];
    $month_year = $_POST['month_year'];
    $basic_salary = $_POST['basic_salary'];
    $allowance = $_POST['allowance'];

    // Gọi hàm để thêm thông tin lương
    addSalary($employee_id, $month_year, $basic_salary, $allowance);
}
?>