<?php
// Lấy dữ liệu từ db lên và chuyển thành json để dùng spark phân tích
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // require "../../database/db_helper.php";
    require "../database/db_helper.php";//ok
    // require "database/db_helper.php";

    $list_employee_info = getAllInfo();
    // echo "<pre>";
    // print_r($list_employee_info);
    // echo "</pre>";
     // Chuyển dữ liệu thành JSON
     $json_data = json_encode($list_employee_info, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

     // Đường dẫn tới file JSON bạn muốn lưu
     $file_path = "employee_info.json";
 
     // Lưu JSON vào file
     if (file_put_contents($file_path, $json_data)) {
         echo "Dữ liệu đã được lưu vào file JSON thành công!";
     } else {
         echo "Lỗi khi lưu dữ liệu vào file JSON.";
     }
?>
