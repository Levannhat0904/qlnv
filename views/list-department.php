<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Gọi hàm getDepartments() để lấy danh sách phòng ban
$departments = getDepartments();

// Kiểm tra nếu có từ khóa tìm kiếm
$search_query = isset($_POST['search']) ? $_POST['search'] : '';

// Hàm tìm kiếm phòng ban
function searchDepartments($search_query) {
    global $conn; // Kết nối cơ sở dữ liệu

    // Truy vấn tìm kiếm phòng ban theo tên
    $sql = "SELECT * FROM Departments WHERE department_name LIKE '%$search_query%'";
    $result = $conn->query($sql);
    $departments = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }
    }
    return $departments;
}

// Nếu có từ khóa tìm kiếm, gọi hàm tìm kiếm
if (!empty($search_query)) {
    $departments = searchDepartments($search_query);
}
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0">Danh sách phòng ban</h5>
            <div class="form-search form-inline">
                <form action="?view=list-department" method="POST">
                    <input type="text" name="search" class="form-control form-search" placeholder="Tìm kiếm phòng ban" value="<?php echo htmlspecialchars($search_query); ?>">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <!-- <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="action">
                    <option>Chọn</option>
                    <option>Tác vụ 1</option>
                    <option>Tác vụ 2</option>
                </select>
                <input type="submit" name="btn-action" value="Áp dụng" class="btn btn-primary">
            </div> -->
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Tên phòng ban</th>
                        <th scope="col">Địa điểm</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($departments)) {
                        // Hiển thị dữ liệu trong bảng
                        $index = 1;
                        foreach ($departments as $department) {
                            echo "<tr>
                                    <td><input type='checkbox'></td>
                                    <td>{$index}</td>
                                    <td>" . htmlspecialchars($department['department_name']) . "</td>
                                    <td>" . htmlspecialchars($department['location']) . "</td>
                                    <td>
                                        <a href='?view=edit_department&id={$department['department_id']}' class='btn btn-success btn-sm rounded-0 text-white' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i></a>
                                        <a href='controller/delete_department.php?id={$department['department_id']}' class='btn btn-danger btn-sm rounded-0 text-white' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-trash'></i></a>
                                    </td>
                                </tr>";
                            $index++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">Trước</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav> -->
        </div>
    </div>
</div>

<?php
$conn->close(); // Đóng kết nối
?>
