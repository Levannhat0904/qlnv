<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Thông tin kết nối MySQL
$servername = "localhost"; // Địa chỉ máy chủ MySQL
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "employee_management"; // Tên cơ sở dữ liệu


// Kết nối với MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng employee_salaries
$sql = "SELECT * FROM Employees";
    $result = $conn->query($sql);

    $employees = array(); // Tạo mảng để lưu danh sách nhân viên

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row; // Thêm từng nhân viên vào mảng
        }
    } else {
        echo "Không có nhân viên nào.";
    }

// Chuyển đổi mảng thành JSON
$json_data = json_encode($employees, JSON_PRETTY_PRINT);
print_r($json_data);

// Lưu JSON vào tệp
$file_name = 'employee_salaries.json';
if (file_put_contents($file_name, $json_data)) {
    echo "Dữ liệu đã được xuất ra tệp $file_name thành công.";
} else {
    echo "Có lỗi khi ghi dữ liệu vào tệp.";
}

// Đóng kết nối
$conn->close();
?>
