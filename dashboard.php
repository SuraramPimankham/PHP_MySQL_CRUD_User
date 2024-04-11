<?php
session_start();

// ตรวจสอบว่ามีการล็อกอินหรือไม่
if(!isset($_SESSION['username'])) {
    header('Location: index.html'); // ถ้าไม่ได้ล็อกอินให้เปลี่ยนไปหน้า login
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#"></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="navbar-text mr-3">
                        <?php echo $_SESSION['username']; ?>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-danger" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>CRUD by <?php echo $_SESSION['username']; ?></h1><a href='add.php' class='btn btn-success'>Add</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Mobile</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
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

            // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง users
            $sql = "SELECT * FROM users";
            $result = $conn->query($sql);

            // ตรวจสอบว่ามีข้อมูลในฐานข้อมูลมั้ย
            if ($result->num_rows > 0) {
                // แสดงข้อมูลในตาราง
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["pass"] . "</td>";
                    echo "<td>" . $row["mobile"] . "</td>";
                    echo "<td>";
                    // เช็คว่า username ของข้อมูลนี้เหมือนกับ username ที่ login อยู่มั้ย
                    if ($_SESSION['username'] === $row["username"]) {
                        echo "<span class='text-success'>Currently in use</span>";
                    } else {
                        echo "<a href='edit.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>";
                        echo "<a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }

            // ปิดการเชื่อมต่อฐานข้อมูล
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
