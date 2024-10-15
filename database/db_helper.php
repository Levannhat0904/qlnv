<?php
$servername = "localhost"; // Địa chỉ máy chủ MySQL
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "employee_management"; // Tên cơ sở dữ liệu

// Tạo kết nối
if (!isset($conn)) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    // echo "<script>alert('Kết nối thành công!');</script>";
}
//================================================================================================================================
// Hàm Thêm Nhân Viên
function addEmployee($full_name, $email, $phone_number, $hire_date, $job_title, $department_id, $salary)
{
    // return "sffdsfdsf";
    global $conn;
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    // echo "<script>alert('Kết nối rất thành công!');</script>";
    // $conn = connectDatabase();
    $sql = "INSERT INTO Employees (full_name, email, phone_number, hire_date, job_title, department_id, salary)
            VALUES ('$full_name', '$email', '$phone_number', '$hire_date', '$job_title', $department_id, $salary)";
    // return $sql;
    // return "ksdjdjs";
    if ($conn->query($sql) === TRUE) {
        // Thông báo đã thêm nhân viên thành công
        echo "<script>
            alert('Thêm mới thành công!');
            window.location.href = '../?view=list-user';
        </script>";
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $conn->close();
    return "dfdss";
}
// Hàm Cập Nhật Nhân Viên
function updateEmployee($employee_id, $full_name, $email, $phone_number, $hire_date, $job_title, $department_id, $salary)
{
    // $conn = connectDatabase();
    global $conn;
    $sql = "UPDATE Employees 
            SET full_name='$full_name', email='$email', phone_number='$phone_number', 
                hire_date='$hire_date', job_title='$job_title', 
                department_id=$department_id, salary=$salary 
            WHERE employee_id=$employee_id";

    if ($conn->query($sql) === TRUE) {
        echo "Nhân viên đã được cập nhật thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $conn->close();
}
// Hàm Xóa Nhân Viên
function deleteEmployee($employee_id)
{
    // $conn = connectDatabase();
    global $conn;
    $sql = "DELETE FROM Employees WHERE employee_id=$employee_id";

    if ($conn->query($sql) === TRUE) {
        echo "Nhân viên đã được xóa thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $conn->close();
}
function getEmployeeById($employee_id)
{
    global $conn; // Sử dụng biến kết nối toàn cục

    // Câu truy vấn SQL để lấy thông tin nhân viên theo ID
    $sql = "SELECT * FROM Employees WHERE employee_id = $employee_id";

    // Thực thi truy vấn
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả và trả về thông tin nhân viên
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result); // Trả về thông tin nhân viên dưới dạng mảng kết hợp
    } else {
        return null; // Trả về null nếu không có nhân viên nào với ID tương ứng
    }
}
function deleteEmployeeById($employee_id) {
    global $conn; // Sử dụng biến kết nối toàn cục

    // Kiểm tra xem employee_id có hợp lệ không
    if (!empty($employee_id)) {
        // Chuẩn bị câu truy vấn SQL để xóa nhân viên
        $sql = "DELETE FROM Employees WHERE employee_id = '$employee_id'";

        // Thực thi câu truy vấn
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Xoá nhân viên thành công!');
                window.location.href = '../?view=list-user';
            </script>";
        exit();
        } else {
            return "Lỗi: " . $conn->error;
        }
    } else {
        return "ID nhân viên không hợp lệ.";
    }
}
function searchEmployees($search_query) {
    global $conn; // Kết nối cơ sở dữ liệu

    // Truy vấn tìm kiếm nhân viên theo tên, email hoặc chức vụ
    $sql = "SELECT * FROM Employees 
            WHERE full_name LIKE '%$search_query%' 
            OR email LIKE '%$search_query%'
            OR job_title LIKE '%$search_query%'";

    $result = $conn->query($sql);
    $employees = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
    }
    return $employees;
}


// Hàm Lấy Danh Sách Nhân Viên
function getEmployees()
{
    global $conn; // Sử dụng biến kết nối toàn cục
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

    // Trả về danh sách nhân viên
    return $employees;
}

// Hàm Lấy Danh Sách Phòng Ban
function getDepartmentName($department_id)
{
    global $conn; // Sử dụng biến kết nối cơ sở dữ liệu toàn cục

    // Truy vấn để lấy tên phòng ban dựa trên department_id
    $sql = "SELECT department_name FROM Departments WHERE department_id = $department_id";
    $result = $conn->query($sql);

    // Kiểm tra kết quả
    if ($result->num_rows > 0) {
        // Lấy hàng đầu tiên từ kết quả
        $row = $result->fetch_assoc();
        return $row['department_name'];
    } else {
        // Trả về giá trị mặc định nếu không tìm thấy phòng ban
        return "Không xác định";
    }
}
// =================================================================================================
// Phòng ban
function addDepartment($department_name, $location)
{
    global $conn;

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    // Câu truy vấn SQL thêm phòng ban
    $sql = "INSERT INTO Departments (department_name, location) VALUES ('$department_name', '$location')";

    // Thực thi câu truy vấn
    if ($conn->query($sql) === TRUE) {
        // Thông báo đã thêm phòng ban thành công
        echo "<script>
            alert('Thêm phòng ban thành công!');
            window.location.href = '../?view=list-department';
        </script>";
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
function getDepartments()
{
    global $conn; // Sử dụng biến kết nối toàn cục
    $sql = "SELECT * FROM Departments"; // Truy vấn lấy tất cả phòng ban
    $result = $conn->query($sql); // Thực hiện truy vấn

    $departments = array(); // Tạo mảng để lưu danh sách phòng ban

    // Kiểm tra xem có dữ liệu nào không
    if ($result->num_rows > 0) {
        // Lặp qua từng hàng dữ liệu
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row; // Thêm từng phòng ban vào mảng
        }
    } else {
        echo "Không có phòng ban nào."; // Thông báo nếu không có dữ liệu
    }

    // Trả về danh sách phòng ban
    return $departments;
}
// Hàm lấy thông tin phòng ban theo ID
function getDepartmentById($id) {
    global $conn; // Kết nối cơ sở dữ liệu

    // Truy vấn SQL để lấy thông tin phòng ban theo department_id
    $sql = "SELECT * FROM Departments WHERE department_id = $id"; // Chú ý: Không sử dụng Prepared Statements ở đây

    // Thực hiện truy vấn
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả
    if ($result) {
        return mysqli_fetch_assoc($result); // Trả về dữ liệu phòng ban
    } else {
        // Xử lý lỗi nếu cần
        echo "Lỗi truy vấn: " . mysqli_error($conn);
        return null; // Trả về null nếu không tìm thấy dữ liệu
    }
}
function updateDepartment($id, $department_name, $location) {
    global $conn; // Kết nối cơ sở dữ liệu

    // Truy vấn cập nhật phòng ban
    $sql = "UPDATE Departments SET department_name = '$department_name', location = '$location' WHERE department_id = $id"; // Chú ý: Không sử dụng Prepared Statements ở đây

    // Thực hiện truy vấn
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Chỉnh sửa phòng ban thành công!');
                window.location.href = '../../?view=list-department';
            </script>";
    } else {
        echo "<div class='alert alert-danger'>Có lỗi xảy ra: " . mysqli_error($conn) . "</div>";
    }
}

