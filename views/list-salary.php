<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$search_query = isset($_POST['search_query']) ? $_POST['search_query'] : '';
// Lấy thông tin lương của từng nhân viên
// Nếu có từ khóa tìm kiếm, gọi hàm searchEmployees, ngược lại lấy toàn bộ nhân viên
if (!empty($search_query)) {
    $salaries = getSalariesWithEmployeeInfo($search_query);
} else {
    $salaries = getSalariesWithEmployeeInfo($search_query);
}
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách lương nhân viên</h5>
            <div class="form-search form-inline">
                <form action="?view=list-salary" method="POST"> <!-- Gửi dữ liệu tìm kiếm qua GET -->
                    <input type="text" class="form-control form-search" name="search_query" placeholder="Tìm kiếm" value="<?php echo isset($search_query) ? $search_query : ''; ?>">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Ngày áp dụng</th>
                        <th>Lương cơ bản</th>
                        <th>Phụ cấp</th>
                        <th>Tổng</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                <?php
                    if (!empty($salaries)) {
                        $i = 1;
                        foreach ($salaries as $salary) {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $salary['full_name'] . "</td>";
                            echo "<td>" . $salary['email'] . "</td>";
                            echo "<td>" . $salary['month_year'] . "</td>";
                            echo "<td>" . number_format($salary['basic_salary'], 2) . "</td>";
                            echo "<td>" . number_format($salary['allowance'], 2) . "</td>";
                            echo "<td>" . number_format(($salary['allowance']+$salary['basic_salary']), 2) . "</td>";
                            echo "<td>
                                    <a href='?view=edit-salary&id={$salary['salary_id']}' class='btn btn-success btn-sm rounded-0 text-white'><i class='fa fa-edit'></i></a>
                                    <a href='controller/salary/delete_salary.php?id={$salary['salary_id']}' class='btn btn-danger btn-sm rounded-0 text-white'><i class='fa fa-trash'></i></a>
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