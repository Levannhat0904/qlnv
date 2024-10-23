from pyspark.sql import SparkSession

spark = SparkSession.builder \
    .appName("JSON Analysis") \
    .getOrCreate()

print("Bắt đầu đọc tập tin JSON...================================================================")
# df = spark.read.json("file:///Applications/XAMPP/xamppfiles/htdocs/qlvn/spark/data_employee.json", multiLine=True)
df = spark.read.json("data_employee.json", multiLine=True)
# df.printSchema()
df.show(50)

print("Đã đọc tập tin JSON thành công. =================================================================================")

# Xóa dữ liệu cũ và ghi dữ liệu mới vào tệp JSON
output_file = "data_analysis.json"  # Đường dẫn tệp đầu ra

# Ghi dữ liệu vào tệp JSON mới (sẽ xóa tệp cũ nếu đã tồn tại)
df.coalesce(1).write.json(output_file, mode="overwrite")  # Ghi đè tệp nếu đã tồn tại

print(f"Dữ liệu đã được ghi vào tệp {output_file} thành công.")

# Dừng Spark session
spark.stop()
