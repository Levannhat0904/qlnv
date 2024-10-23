<?php
// Kiểm tra xem id của phòng ban có được truyền qua GET không
if (isset($_GET['id'])) {
    $department_id = $_GET['id'];

    // Kết nối đến cơ sở dữ liệu và lấy thông tin phòng ban
    $department = getDepartmentById($department_id); // Giả sử bạn đã có hàm này

    // Kiểm tra nếu phòng ban tồn tại
    if (!$department) {
        echo "<div class='alert alert-danger'>Phòng ban không tồn tại.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Không tìm thấy id phòng ban.</div>";
    exit;
}
?>

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa phòng ban
        </div>
        <div class="card-body">
            <form method="POST" action="controller/department/update_department.php"> <!-- Để gửi lại tới chính file này -->
            <input type="hidden" name="department_id" value="<?php echo htmlspecialchars($department['department_id']); ?>">
                <div class="form-group">
                    <label for="department_name">Tên phòng ban</label>
                    <input class="form-control" type="text" name="department_name" id="department_name" value="<?php echo htmlspecialchars($department['department_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="location">Vị trí</label>
                    <input class="form-control" type="text" name="location" id="location" value="<?php echo htmlspecialchars($department['location']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>


