<?php

$employee_id  = $_GET["id"];
$employee = getEmployeeById($employee_id); // Lấy thông tin nhân viên từ DB

if ($employee) {
    // Lưu các giá trị vào biến để sử dụng trong form
    $full_name = $employee['full_name'];
    $email = $employee['email'];
    $phone_number = $employee['phone_number'];
    $hire_date = $employee['hire_date'];
    $job_title = $employee['job_title'];
    $department_id = $employee['department_id'];
    $salary = $employee['salary'];
} else {
    echo "Không tìm thấy nhân viên với ID: $employee_id";
}
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa thông tin nhân viên
        </div>
        <div class="card-body">
            <form method="POST" action="controller/update_user.php"> <!-- Thay "update_user.php" bằng file xử lý của bạn -->
                <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>"> <!-- Trường ẩn chứa ID nhân viên -->

                <div class="form-group">
                    <label for="full_name">Họ và tên</label>
                    <input class="form-control" type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Số điện thoại</label>
                    <input class="form-control" type="text" name="phone_number" id="phone_number" value="<?php echo $phone_number; ?>">
                </div>

                <div class="form-group">
                    <label for="hire_date">Ngày tuyển dụng</label>
                    <input class="form-control" type="date" name="hire_date" id="hire_date" value="<?php echo $hire_date; ?>" required>
                </div>

                <div class="form-group">
                    <label for="job_title">Chức vụ</label>
                    <select class="form-control" name="job_title" id="job_title" required>
                        <option value="">Chọn chức vụ</option>
                        <option value="manager" <?php if($job_title == 'manager') echo 'selected'; ?>>Quản lý</option>
                        <option value="developer" <?php if($job_title == 'developer') echo 'selected'; ?>>Lập trình viên</option>
                        <option value="designer" <?php if($job_title == 'designer') echo 'selected'; ?>>Nhà thiết kế</option>
                        <option value="analyst" <?php if($job_title == 'analyst') echo 'selected'; ?>>Phân tích viên</option>
                        <option value="hr" <?php if($job_title == 'hr') echo 'selected'; ?>>Nhân viên nhân sự</option>
                        <option value="sales" <?php if($job_title == 'sales') echo 'selected'; ?>>Nhân viên kinh doanh</option>
                        <option value="marketing" <?php if($job_title == 'marketing') echo 'selected'; ?>>Nhân viên marketing</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="department">Phòng ban</label>
                    <select class="form-control" name="department" id="department" required>
                        <option value="">Chọn phòng ban</option>
                        <option value="1" <?php if($department_id == 1) echo 'selected'; ?>>Phòng Kinh doanh</option>
                        <option value="2" <?php if($department_id == 2) echo 'selected'; ?>>Phòng Kỹ thuật</option>
                        <option value="3" <?php if($department_id == 3) echo 'selected'; ?>>Phòng Hành chính</option>
                        <option value="4" <?php if($department_id == 4) echo 'selected'; ?>>Phòng Marketing</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="salary">Mức lương</label>
                    <input class="form-control" type="number" name="salary" id="salary" value="<?php echo $salary; ?>" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
