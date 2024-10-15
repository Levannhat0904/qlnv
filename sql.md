-- Tạo cơ sở dữ liệu
CREATE DATABASE employee_management;

-- Sử dụng cơ sở dữ liệu vừa tạo
USE employee_management;

-- Tạo bảng Departments
CREATE TABLE Departments (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(100) NOT NULL,
    location VARCHAR(100)
);

-- Tạo bảng Employees
CREATE TABLE Employees (
    employee_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone_number VARCHAR(15),
    hire_date DATE NOT NULL,
    job_title VARCHAR(50),
    department_id INT,
    salary DECIMAL(10, 2) NOT NULL,
    leave_days INT DEFAULT 30,
    salary_type VARCHAR(20),
    FOREIGN KEY (department_id) REFERENCES Departments(department_id)
);

-- Tạo bảng Projects
CREATE TABLE Projects (
    project_id INT PRIMARY KEY AUTO_INCREMENT,
    project_name VARCHAR(100) NOT NULL,
    start_date DATE,
    end_date DATE,
    budget DECIMAL(10, 2)
);

-- Tạo bảng Employee_Projects
CREATE TABLE Employee_Projects (
    employee_id INT,
    project_id INT,
    role VARCHAR(50),
    PRIMARY KEY (employee_id, project_id),
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id),
    FOREIGN KEY (project_id) REFERENCES Projects(project_id)
);

-- Tạo bảng Leave_Records
CREATE TABLE Leave_Records (
    leave_id INT PRIMARY KEY AUTO_INCREMENT,
    employee_id INT,
    leave_start_date DATE NOT NULL,
    leave_end_date DATE NOT NULL,
    leave_type VARCHAR(20),
    reason TEXT,
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id)
);
============================================================================
Giải thích các bảng
Departments: Lưu trữ thông tin về các phòng ban trong công ty.

department_id: Mã phòng ban.
department_name: Tên phòng ban.
location: Địa điểm của phòng ban.
============================================================================
Employees: Lưu trữ thông tin về nhân viên.

employee_id: Mã nhân viên.
first_name và last_name: Tên và họ của nhân viên.
email: Địa chỉ email của nhân viên (được đặt là duy nhất).
phone_number: Số điện thoại.
hire_date: Ngày tuyển dụng.
job_title: Chức vụ của nhân viên.
department_id: Liên kết đến bảng Departments.
salary: Mức lương của nhân viên.
leave_days: Số ngày nghỉ phép còn lại.
salary_type: Kiểu lương (hàng tháng, hàng năm, theo giờ).
=============================================================================
Projects: Lưu trữ thông tin về các dự án của công ty.

project_id: Mã dự án.
project_name: Tên dự án.
start_date và end_date: Ngày bắt đầu và kết thúc dự án.
budget: Ngân sách cho dự án.
Employee_Projects: Bảng liên kết giữa nhân viên và dự án, để xác định nhân viên nào tham gia dự án nào.

employee_id: Mã nhân viên.
project_id: Mã dự án.
role: Vai trò của nhân viên trong dự án.
Leave_Records: Lưu trữ thông tin về các ngày nghỉ của nhân viên.

leave_id: Mã ghi chép nghỉ.
employee_id: Mã nhân viên.
leave_start_date và leave_end_date: Ngày bắt đầu và kết thúc nghỉ.
leave_type: Loại nghỉ (ví dụ: nghỉ phép, ốm đau).
reason: Lý do nghỉ.