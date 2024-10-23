<?php
$employees = getEmployeesSortedByName();
print_r($employees);
?>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm thông tin lương
        </div>
        <div class="card-body">
            <form method="POST" action="controller/salary/add_salary.php">
                <!-- <div class="form-group">
                    <label for="employee_id">Mã nhân viên</label>
                    <input class="form-control" type="number" name="employee_id" id="employee_id" required>
                </div> -->
                <div class="form-group">
                    <label for="employee_id">Chọn nhân viên</label>
                    <select class="form-control" name="employee_id" id="employee_id" required>
                        <option value="">Chọn nhân viên</option>
                        <?php if (!empty($employees)) : ?>
                            <?php foreach ($employees as $employee) : ?>
                                <option value="<?php echo $employee['employee_id']; ?>">
                                    <?php echo $employee['full_name']." - ". $employee['email']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <option value="">Không có nhân viên nào</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="month_year">Ngày áp dụng</label>
                    <input class="form-control" type="date" name="month_year" id="month_year" required>
                </div>
                <div class="form-group">
                    <label for="basic_salary">Lương cơ bản</label>
                    <input class="form-control" type="number" name="basic_salary" id="basic_salary" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="allowance">Phụ cấp</label>
                    <input class="form-control" type="number" name="allowance" id="allowance" step="0.01">
                </div>
                <button type="submit" class="btn btn-primary">Thêm lương</button>
            </form>
        </div>
    </div>
</div>