<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../database/db_helper.php";
$employees = getEmployeesSortedByName();
echo json_encode($employees); // Trả về dữ liệu JSON
try {
     // Ghi dữ liệu vào tệp JSON
     file_put_contents('data_employee.json', json_encode($employees, JSON_PRETTY_PRINT));

     echo "Dữ liệu đã được ghi vào tệp JSON thành công.";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>