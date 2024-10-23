<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "dsa";
require "../../database/db_helper.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $salary_id = $_POST['salary_id'];
    $month_year = $_POST['month_year'];
    $basic_salary = $_POST['basic_salary'];
    $allowance = $_POST['allowance'];
    // Câu truy vấn cập nhật thông tin lương
    updateSalary($salary_id, $month_year, $basic_salary, $allowance);
}
?>