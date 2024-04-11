<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Edit User</div>
                    <div class="card-body">
                        <?php
                        // ดึงข้อมูลของผู้ใช้จากฐานข้อมูลโดยใช้ไอดีที่รับมาจาก URL
                        $id = $_GET['id']; // ไอดีของผู้ใช้ที่ต้องการแก้ไข

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

                        // คำสั่ง SQL เพื่อดึงข้อมูลของผู้ใช้ที่ต้องการแก้ไข
                        $sql = "SELECT * FROM users WHERE id = $id";
                        $result = $conn->query($sql);

                        // ตรวจสอบว่ามีข้อมูลมั้ย
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            ?>
                            <form id="editForm" method="POST" action="update.php">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required placeholder="Username" value="<?php echo $row['username']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required placeholder="Password" value="<?php echo $row['pass']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" pattern="[0-9]*" maxlength="10" title="Please enter only digits (0-9)" value="<?php echo $row['mobile']; ?>">
                                </div>
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="dashboard.php" class="btn btn-secondary">Back</a>
                            </form>
                            <?php
                        } else {
                            echo "User not found";
                        }

                        // ปิดการเชื่อมต่อฐานข้อมูล
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
