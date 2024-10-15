<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = 'database-1.cp80m0wgc1ht.ap-southeast-1.rds.amazonaws.com';
$db   = 'qlnv'; // Thay đổi thành tên cơ sở dữ liệu của bạn
$user = 'admin'; // Thay đổi thành tên người dùng của bạn
$pass = 'Levannhat0904?'; // Thay đổi thành mật khẩu của bạn
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Kết nối thành công đến RDS!";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
