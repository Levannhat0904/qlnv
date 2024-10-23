<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "../database/db_helper.php";
// $str= addEmployee(232,23123,23,12312,31,3213,3123);
// echo "sdsa";
// echo $str;
// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $hire_date = $_POST['hire_date'];
    $job_title = $_POST['job_title'];
    $department_id = $_POST['department'];
    // $salary = $_POST['salary'];
    addEmployee($full_name, $email, $phone_number, $hire_date, $job_title, $department_id);

    // echo $str;
    // Thông báo đã thêm nhân viên thành công
    // echo "<script>
    //     alert('Kết nối thành công!');
    //     window.location.href = '../?view=list-user';
    //   </script>";
    // exit();
}
