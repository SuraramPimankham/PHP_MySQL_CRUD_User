<?php
// เชื่อมต่อกับฐานข้อมูล MySQL
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "users";
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับไอดีของผู้ใช้ที่ต้องการลบจาก query parameter (id) ที่ส่งมา
$id = $_GET['id'];

// คำสั่ง SQL เพื่อลบข้อมูลของผู้ใช้
$sql = "DELETE FROM users WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // ถ้าลบข้อมูลสำเร็จ
    echo "Record deleted successfully";
    header('Location: dashboard.php'); // เปลี่ยนเส้นทางไปยังหน้า dashboard.php
    exit(); // หยุดการทำงานของสคริปต์ต่อไป
} else {
    // ถ้าเกิดข้อผิดพลาดในการลบข้อมูล
    echo "Error deleting record: " . $conn->error;
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
