<?php
$salary_id  = $_GET["id"];
$salary_employee = getSalaryBySalaryId($salary_id); // Lấy thông tin nhân viên từ DB
print_r($salary_employee);
if ($salary_employee) {
    $month_year = $salary_employee['month_year'];
    // Lưu các giá trị vào biến để sử dụng trong form
    // $salary_id = $salary_employee['full_name'];
    $full_name = $salary_employee['full_name'];
    $email = $salary_employee['email'];
    $basic_salary = $salary_employee['basic_salary'];
    $allowance = $salary_employee['allowance'];
} else {
    echo "Không tìm thấy nhân viên với ID: $employee_id";
}
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa thông tin lương nhân viên
        </div>
        <div class="card-body">
            <form method="POST" action="controller/salary/update_salary.php">
                <div class="form-group">
                    <label for="full_name">Họ tên nhân viên</label>
                    <input class="form-control" type="text" name="full_name" id="full_name" value="<?php echo $full_name;?>" disabled>
                </div>
                <div class="form-group">
                    <!-- <label for="salary_id">Họ tên nhân viên</label> -->
                    <input class="form-control" type="hidden" name="salary_id" id="salary_id" value="<?php echo $salary_id;?>">
                </div>

                <div class="form-group">
                    <label for="month_year">Ngày áp dụng</label>
                    <input class="form-control" type="date" name="month_year" value="<?php echo $month_year; ?>" id="month_year" required>
                </div>

                <div class="form-group">
                    <label for="basic_salary">Lương cơ bản</label>
                    <input class="form-control" type="number" name="basic_salary" id="basic_salary" step="0.01" value="<?php echo $basic_salary; ?>" required>
                </div>

                <div class="form-group">
                    <label for="allowance">Phụ cấp</label>
                    <input class="form-control" type="number" name="allowance" id="allowance" step="0.01" value="<?php echo $allowance; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật lương</button>
            </form>
        </div>
    </div>
</div>
