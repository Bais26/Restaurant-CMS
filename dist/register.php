<?php
include 'config/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if (empty($username) || empty($password) || empty($cpassword)) {
        echo "Mohon isi semua kolom registrasi.";
    } else {
        if ($password != $cpassword) {
            echo "Password dan konfirmasi password tidak cocok.";
        } else {
            $checkQuery = "SELECT * FROM admins WHERE username='$username'";
            $checkResult = $conn->query($checkQuery);

            if ($checkResult->num_rows > 0) {
                echo "Username sudah terdaftar. Silakan gunakan yang lain.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$hashedPassword')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Registrasi berhasil. Silakan <a href='index.php'>login</a>.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register</title>
</head>
<body style="display: flex; align-items: center; justify-content: center; height: 100vh; font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0;">

    <div class="container" style="width: 300px; background-color: #fff; border: 1px solid #ccc; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">
    <i class="fa-solid fa-bowl-food" style="font-size: 32px;"></i>
        <form action="" method="POST" class="login-email" style="display: flex; flex-direction: column;">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; text-align: center; margin-bottom: 20px;">Register</p>
            <div class="input-group" style="margin-bottom: 15px;">
                <input type="text" placeholder="Username" name="username" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
            </div>
            <div class="input-group" style="margin-bottom: 15px;">
                <input type="password" placeholder="Password" name="password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
            </div>
            <div class="input-group" style="margin-bottom: 15px;">
                <input type="password" placeholder="Confirm Password" name="cpassword" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn" style="width: 100%; padding: 8px; border: none; border-radius: 3px; background-color: #007bff; color: #fff; cursor: pointer;">Register</button>
            </div>
            <p class="login-register-text" style="text-align: center; margin-top: 15px;">Sudah memiliki akun? <a href="index.php" style="text-decoration: none; color: #007bff;">Login</a></p>
        </form>
    </div>

</body>
</html>