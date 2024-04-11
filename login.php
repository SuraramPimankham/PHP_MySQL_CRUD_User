<?php
session_start();

// เชื่อมต่อฐานข้อมูล MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$username = $_POST['username'];
$password = $_POST['password'];

// ค้นหาในฐานข้อมูล
$sql = "SELECT * FROM users WHERE username='$username' AND pass='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // ล็อกอินสำเร็จ
    $_SESSION['username'] = $username;
    header('Location: dashboard.php'); // เปลี่ยนเป็นหน้าหลังจากล็อกอินสำเร็จ
} else {
    // ล็อกอินล้มเหลว
    echo "Invalid username or password";
}

$conn->close();
?>
