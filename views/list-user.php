<?php
// Lấy từ khóa tìm kiếm (nếu có)
$search_query = isset($_POST['search_query']) ? $_POST['search_query'] : '';

// Nếu có từ khóa tìm kiếm, gọi hàm searchEmployees, ngược lại lấy toàn bộ nhân viên
if (!empty($search_query)) {
    $employees = searchEmployees($search_query);
} else {
    $employees = getEmployees();
}
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách thành viên</h5>
            <div class="form-search form-inline">
                <form action="?view=list-user" method="POST"> <!-- Gửi dữ liệu tìm kiếm qua GET -->
                    <input type="text" class="form-control form-search" name="search_query" placeholder="Tìm kiếm" value="<?php echo isset($search_query) ? $search_query : ''; ?>">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Chức vụ</th>
                        <th>Phòng ban</th>
                        <th>Mức lương</th>
                        <th>Ngày tuyển dụng</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($employees)) {
                        $i = 1;
                        foreach ($employees as $employee) {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $employee['full_name'] . "</td>";
                            echo "<td>" . $employee['email'] . "</td>";
                            echo "<td>" . $employee['phone_number'] . "</td>";
                            echo "<td>" . $employee['job_title'] . "</td>";
                            echo "<td>" . getDepartmentName($employee['department_id']) . "</td>";
                            echo "<td>" . number_format($employee['salary'], 2) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($employee['hire_date'])) . "</td>";
                            echo "<td>
                                    <a href='?view=edit-user&id={$employee['employee_id']}' class='btn btn-success btn-sm rounded-0 text-white'><i class='fa fa-edit'></i></a>
                                    <a href='controller/delete-user.php?id={$employee['employee_id']}' class='btn btn-danger btn-sm rounded-0 text-white'><i class='fa fa-trash'></i></a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Không tìm thấy nhân viên nào.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>