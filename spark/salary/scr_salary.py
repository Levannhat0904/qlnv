from pyspark.sql import SparkSession
from pyspark.sql.functions import col

# Tạo Spark session
spark = SparkSession.builder \
    .appName("JSON Analysis") \
    .config("spark.driver.bindAddress", "127.0.0.1")\
    .getOrCreate()

print("Bắt đầu đọc tập tin JSON...================================================================")
# Đọc dữ liệu từ file JSON
df = spark.read.json("../employee_info.json", multiLine=True)

# Lấy 10 nhân viên có lương cao nhất dựa trên cột `final_salary`
top_10_salaries = df.orderBy(col("final_salary").cast("float").desc()).limit(10)

# Hiển thị kết quả  
top_10_salaries.show()
output_file = "data_analysis.json"  # Đường dẫn tệp đầu ra

# Ghi dữ liệu vào tệp JSON mới (sẽ xóa tệp cũ nếu đã tồn tại)
top_10_salaries.write.json(output_file, mode="overwrite") 
 # Ghi đè tệp nếu đã tồn tại

print(f"Dữ liệu đã được ghi vào tệp {output_file} thành công.")

# Dừng Spark session
spark.stop()