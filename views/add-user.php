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
$departments = getDepartments();
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm nhân viên
        </div>
        <div class="card-body">
            <form method="POST" action="controller/add_user.php"> <!-- Thay "your_php_file.php" bằng tên file PHP của bạn -->
                <div class="form-group">
                    <label for="full_name">Họ và tên</label>
                    <input class="form-control" type="text" name="full_name" id="full_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Số điện thoại</label>
                    <input class="form-control" type="text" name="phone_number" id="phone_number">
                </div>
                <div class="form-group">
                    <label for="hire_date">Ngày tuyển dụng</label>
                    <input class="form-control" type="date" name="hire_date" id="hire_date" required>
                </div>
                <div class="form-group">
                    <label for="job_title">Chức vụ</label>
                    <select class="form-control" name="job_title" id="job_title" required>
                        <option value="">Chọn chức vụ</option>
                        <option value="manager">Quản lý</option>
                        <option value="developer">Lập trình viên</option>
                        <option value="designer">Nhà thiết kế</option>
                        <option value="analyst">Phân tích viên</option>
                        <option value="hr">Nhân viên nhân sự</option>
                        <option value="sales">Nhân viên kinh doanh</option>
                        <option value="marketing">Nhân viên marketing</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="department">Phòng ban</label>
                    <select class="form-control" name="department" id="department" required>
                        <option value="">Chọn phòng ban</option>
                        <?php if (!empty($departments)) : ?>
                            <?php foreach ($departments as $department) : ?>
                                <option value="<?php echo $department['department_id']; ?>">
                                    <?php echo $department['department_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">Không có phòng ban nào</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="salary">Mức lương</label>
                    <input class="form-control" type="number" name="salary" id="salary" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>