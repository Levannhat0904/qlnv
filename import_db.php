<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Thông tin kết nối
$host = 'database-1.cxuy0au02kfl.ap-southeast-1.rds.amazonaws.com';
$username = 'admin';
$password = 'Levannhat0904?';
$database = 'employee_management';

// Kết nối đến MySQL
$conn = new mysqli($host, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo cơ sở dữ liệu nếu chưa tồn tại
$conn->query("CREATE DATABASE IF NOT EXISTS $database");
$conn->select_db($database);

// Câu lệnh SQL tạo các bảng
$sql = <<<SQL
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `Departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `phone_number` varchar(15) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  FOREIGN KEY (`department_id`) REFERENCES `Departments` (`department_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Salaries` (
  `salary_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `month_year` date NOT NULL,
  `basic_salary` decimal(10,2) NOT NULL,
  `allowance` decimal(10,2) DEFAULT 0.00,
  `final_salary` decimal(10,2) GENERATED ALWAYS AS (`basic_salary` + `allowance`) STORED,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`salary_id`),
  FOREIGN KEY (`employee_id`) REFERENCES `Employees` (`employee_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;
SQL;

// Thực thi câu lệnh SQL
if ($conn->multi_query($sql) === TRUE) {
    echo "Tạo cơ sở dữ liệu và các bảng thành công!";
} else {
    echo "Lỗi: " . $conn->error;
}

// Đóng kết nối
$conn->close();
