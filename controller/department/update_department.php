<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../../database/db_helper.php";
// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form và loại bỏ khoảng trắng thừa
    $department_name = trim($_POST['department_name']);
    $location = trim($_POST['location']);
    $department_id =trim($_POST['department_id']);

    // Kiểm tra dữ liệu đầu vào
    if (!empty($department_name) && !empty($location)) {
        // Gọi hàm cập nhật phòng ban
        updateDepartment($department_id, $department_name, $location);
    } else {
        echo "<div class='alert alert-danger'>Vui lòng điền đầy đủ thông tin!</div>";
    }
}
?>