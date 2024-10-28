# dữ liệu đầu ra là số lượng nhân viên mỗi phòng ban
from pyspark.sql import SparkSession
from pyspark.sql.functions import col, count

spark = SparkSession.builder \
    .appName("JSON Analysis") \
    .config("spark.driver.bindAddress", "127.0.0.1")\
    .getOrCreate()

print("Bắt đầu đọc tập tin JSON...================================================================")
# df = spark.read.json("file:///Applications/XAMPP/xamppfiles/htdocs/qlvn/spark/data_employee.json", multiLine=True)
df = spark.read.json("../employee_info.json", multiLine=True)
# df.printSchema()
# df.show(50)
department_count = df.groupBy("department_name").agg(count("employee_id").alias("number_of_employees"))

# Hiển thị kết quả
department_count.show()
# Xóa dữ liệu cũ và ghi dữ liệu mới vào tệp JSON
output_file = "data_analysis.json"  # Đường dẫn tệp đầu ra

# Ghi dữ liệu vào tệp JSON mới (sẽ xóa tệp cũ nếu đã tồn tại)
department_count.write.json(output_file, mode="overwrite")  # Ghi đè tệp nếu đã tồn tại

print(f"Dữ liệu đã được ghi vào tệp {output_file} thành công.")

# Dừng Spark session
spark.stop()

