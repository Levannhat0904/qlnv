<?php
// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $hire_date = $_POST['hire_date'];
    $job_title = $_POST['job_title'];
    $department_id = $_POST['department'];
    $salary = $_POST['salary'];

    // Gọi hàm thêm nhân viên
    // addEmployee($full_name, $email, $phone_number, $hire_date, $job_title, $department_id, $salary);
}
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm phòng ban
        </div>
        <div class="card-body">
            <form method="POST" action="controller/add_department.php"> <!-- Thay "your_php_file.php" bằng tên file PHP của bạn -->
                <div class="form-group">
                    <label for="department_name">Tên phòng ban</label>
                    <input class="form-control" type="text" name="department_name" id="department_name" required>
                </div>
                <div class="form-group">
                    <label for="location">Vị trí</label>
                    <input class="form-control" type="text" name="location" id="location" required>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>

