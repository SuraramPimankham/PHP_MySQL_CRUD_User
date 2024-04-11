<?php
// ตรวจสอบว่ามีการส่งค่าข้อมูลผ่าน POST มั้ย
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าที่ส่งมาจากฟอร์มแก้ไข
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];

    // เชื่อมต่อฐานข้อมูล MySQL
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "users";
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // คำสั่ง SQL เพื่ออัปเดตข้อมูลของผู้ใช้
    $sql = "UPDATE users SET username='$username', pass='$password', mobile='$mobile' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        // ถ้าอัปเดตข้อมูลสำเร็จ
        echo "Updated successfully";
        header('Location: dashboard.php'); // เปลี่ยนเส้นทางไปยังหน้า dashboard.php
        exit(); // หยุดการทำงานของสคริปต์ต่อไป
    } else {
        // ถ้าเกิดข้อผิดพลาดในการอัปเดตข้อมูล
        echo "Error updating record: " . $conn->error;
    }
    

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
} else {
    // ถ้าไม่มีการส่งค่าข้อมูลผ่าน POST
    echo "No data submitted";
}
?>
