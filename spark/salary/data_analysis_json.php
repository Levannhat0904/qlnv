<?php
//chyển dữ liệu từ tệp json của spark sang file json để hiển thị dữ liệu
// dữ liệu: nhân viên mỗi phòng ban 
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "sdsadsa";
$directory = 'salary/data_analysis.json'; // Đường dẫn đến thư mục
$outputFile = 'salary/output_data.json'; // Tệp đầu ra

if (is_dir($directory)) {
    $dataList = [];

    // Mở thư mục
    if ($handle = opendir($directory)) {
        // Đọc từng tệp trong thư mục
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != ".." && strpos($entry, 'part-') === 0) {
                $filePath = $directory . '/' . $entry;

                // Đọc dữ liệu từ tệp JSON
                $jsonData = file_get_contents($filePath);
                $lines = explode("\n", trim($jsonData));

                // Giải mã từng dòng JSON và thêm vào danh sách
                foreach ($lines as $line) {
                    if (!empty($line)) {
                        $dataList[] = json_decode($line, true);
                    }
                }
            }
        }
        closedir($handle);
    }

    // Hiển thị dữ liệu
    echo "<h1>Dữ Liệu JSON từ Thư Mục</h1>";
    echo "<pre>" . json_encode($dataList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "</pre>";

    // Ghi dữ liệu vào tệp JSON
    $jsonOutput = json_encode($dataList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
    // Lưu dữ liệu ra tệp
    if (file_put_contents($outputFile, $jsonOutput)) {
        echo "Dữ liệu đã được ghi vào tệp <strong>$outputFile</strong> thành công.";
    } else {
        echo "Có lỗi xảy ra khi ghi dữ liệu vào tệp.";
    }
} else {
    echo "Thư mục không tồn tại.";
}
?>
