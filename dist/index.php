<?php
include 'config/conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php");
        } else {
            echo "<script>alert('Login failed. Please check your username and password.')</script>";
        }
    } else {
        echo "<script>alert('Login failed. Please check your username and password.')</script>";
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
    <title>Login Admin</title>
</head>

<body style="display: flex; align-items: center; justify-content: center; height: 100vh; font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0;">


    <div class="container" style="width: 300px; background-color: #fff; border: 1px solid #ccc; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">
        <i class="fa-solid fa-bowl-food" style="font-size: 32px;"></i>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="login-email" style="display: flex; flex-direction: column;">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; text-align: center; margin-bottom: 20px;">Login</p>

            <div class="input-group" style="margin-bottom: 15px;">
                <input type="text" placeholder="Username" name="username" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
            </div>
            <div class="input-group" style="margin-bottom: 15px;">
                <input type="password" placeholder="Password" name="password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
            </div>
            <div class="input-group">

                <button type="submit" name="login" class="btn" style="width: 100%; padding: 8px; border: none; border-radius: 3px; background-color: #007bff; color: #fff; cursor: pointer;">Login</button>
            </div>

            <p class="login-register-text" style="text-align: center; margin-top: 15px;">Belum memiliki akun? <a href="register.php" style="text-decoration: none; color: #007bff;">Registrasi</a></p>
        </form>
    </div>

</body>

</html>