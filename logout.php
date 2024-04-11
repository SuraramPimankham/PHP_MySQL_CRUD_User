<?php
session_start();
session_unset(); // เคลียร์ตัวแปร session ทั้งหมด
session_destroy(); // ทำลายเซสชัน
header('Location: index.html'); // ย้ายกลับไปยังหน้า login หลังจากล็อกเอาท์
exit();
?>
