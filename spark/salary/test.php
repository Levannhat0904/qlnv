<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>

    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

    <script>
        $(document).ready(function() {
            // Đọc dữ liệu từ file JSON
            $.getJSON('output_data.json', function(jsonData) {
                // Tạo mảng cho các nhãn (tên phòng ban) và tổng lương
                var xValues = jsonData.map(function(item) {
                    return item.full_name;
                });

                // Chuyển đổi final_salary thành số thực và tính tổng lương cho từng phòng ban
                var yValues = jsonData.map(function(item) {
                    return Number(item.final_salary) || 0; // Chuyển đổi giá trị thành số thực
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
                            text: "Top 20 nhân viên lương cao nhất công ty"
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>
