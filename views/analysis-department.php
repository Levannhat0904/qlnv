<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// require "database/db_helper.php";
?>
<div class="container-fluid py-5">
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            Thống kê nhân viên
        </div>
        <div class="card-body">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
            <script>
                $(document).ready(function() {
                    // Đọc dữ liệu từ file JSON
                    $.getJSON('spark/dashboard/output_data.json', function(jsonData) {
                        // Tạo mảng cho các nhãn (tên phòng ban) và số lượng nhân viên
                        var xValues = jsonData.map(function(item) {
                            return item.department_name;
                        });

                        var yValues = jsonData.map(function(item) {
                            return Number(item.number_of_employees) || 0; // Chuyển đổi giá trị sang số
                        });

                        // Hàm tạo màu sắc ngẫu nhiên
                        function getRandomColor() {
                            var letters = '0123456789ABCDEF';
                            var color = '#';
                            for (var i = 0; i < 6; i++) {
                                color += letters[Math.floor(Math.random() * 16)];
                            }
                            return color;
                        }
                        var maxValue = Math.max(...yValues);
                        var yMax = Math.ceil(maxValue * 1.1); // Tăng 10% so với giá trị cao nhất
                        // Định nghĩa màu sắc ngẫu nhiên cho từng cột
                        var barColors = yValues.map(function() {
                            return getRandomColor();
                        });

                        // Tạo biểu đồ
                        new Chart("myChart", {
                            type: "bar",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yValues
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true, // Đảm bảo trục y bắt đầu từ 0,
                                            max: yMax // Thiết lập giá trị tối đa cho trục y
                                        }
                                    }]
                                },
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: "Số lượng nhân viên theo phòng ban"
                                }
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>

</div>