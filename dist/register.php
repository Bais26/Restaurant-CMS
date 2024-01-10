<?php
include 'config/conn.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location:index.php");
    exit();
}

$username = $email = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256

    $stmt = $conn->prepare("INSERT INTO Admin (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        header("Location:index.php");
        exit();
    } else {
        echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
    }
}
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
                <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
            </div>
            <div class="input-group" style="margin-bottom: 15px;">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
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
