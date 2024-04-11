<?php
session_start();

// ตรวจสอบว่ามีการล็อกอินมั้ย
if(!isset($_SESSION['username'])) {
    header('Location: index.html'); // ถ้าไม่ได้ล็อกอินให้เปลี่ยนไปหน้า login
    exit();
}

// ตรวจสอบว่ามีการส่งค่าข้อมูลผ่าน POST มั้ย
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าที่ส่งมาจากฟอร์ม
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

    // คำสั่ง SQL เพื่อเพิ่มข้อมูลใหม่
    $sql = "INSERT INTO users (username, pass, mobile) VALUES ('$username', '$password', '$mobile')";

    if ($conn->query($sql) === TRUE) {
        // ถ้าเพิ่มข้อมูลสำเร็จ
        echo "Created successfully";
        header('Location: dashboard.php'); // เปลี่ยนเส้นทางไปยังหน้า dashboard.php
        exit(); // หยุดการทำงานของสคริปต์ต่อไป
    } else {
        // ถ้าเกิดข้อผิดพลาดในการเพิ่มข้อมูล
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
} else {
    // ถ้าไม่มีการส่งค่าข้อมูลผ่าน POST
    echo "No data submitted";
}
?>
