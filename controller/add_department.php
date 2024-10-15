
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../database/db_helper.php";
// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $department_name = $_POST['department_name'];
    $location = $_POST['location'];

    // Gọi hàm thêm phòng ban
    addDepartment($department_name, $location);
}
