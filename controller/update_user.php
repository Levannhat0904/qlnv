<?php
// include 'db.php'; // Bao gồm file kết nối database
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../database/db_helper.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $employee_id = $_POST['employee_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $hire_date = $_POST['hire_date'];
    $job_title = $_POST['job_title'];
    $department = $_POST['department'];
    // $salary = $_POST['salary'];

    // Kiểm tra xem dữ liệu có đủ không
    if (!empty($full_name) && !empty($email) && !empty($hire_date) && !empty($job_title) && !empty($department)) {

        // Chuẩn bị câu truy vấn SQL
        $sql = "UPDATE Employees SET 
                    full_name = '$full_name', 
                    email = '$email', 
                    phone_number = '$phone_number', 
                    hire_date = '$hire_date', 
                    job_title = '$job_title', 
                    department_id = '$department'
                WHERE employee_id = '$employee_id'";

        // Thực thi câu truy vấn
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Cập nhật thành công!');
                window.location.href = '../?view=list-user';
            </script>";
            exit();
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Vui lòng điền đầy đủ thông tin.";
    }
}

// Đóng kết nối
// $conn->close();
