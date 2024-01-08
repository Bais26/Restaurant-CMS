<?php
include 'config/conn.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.html");
    exit();
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256

    $stmt = $conn->prepare("SELECT * FROM Admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Login berhasil login.')</script>";
        header("Location: dashboard.html");
        exit();
    } else {
        echo "<script>alert('Login gagal. Periksa kembali username dan password Anda.')</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"  href="css/style.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <title>Login Admin</title>
</head>

<body style="display: flex; align-items: center; justify-content: center; height: 100vh; font-family: Arial, sans-serif; background-color: #f0f0f0; margin: 0;">

    <div style="width: 300px; background-color: #fff; border: 1px solid #ccc; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">
        <i class="fa-solid fa-bowl-food" style="font-size: 32px;"></i>
        <form action="dashboard.html" method="POST" style="display: flex; flex-direction: column;" class="needs-validation" novalidate>
            <h2 style="font-size: 1.5rem; text-align: center; margin-bottom: 20px;">Login</h2>
            <div style="margin-bottom: 20px;">
                <input type="text" placeholder="Username" name="username" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
                <div class="invalid-feedback">
                    masukan username yang valid.
                </div>
            </div>
            <div style="margin-bottom: 20px;">
                <input type="password" placeholder="Password" name="password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; box-sizing: border-box;" required>
                <div class="invalid-feedback">
                    masukan username yang valid.
                </div>
            </div>
            <div style="margin-bottom: 20px;">
                <button type="submit" name="submit" style="width: 100%; padding: 8px; border: none; border-radius: 3px; background-color: #007bff; color: #fff; cursor: pointer;">Login</button>
            </div>
            <p style="text-align: center;">Create admin account <a href="register.php" style="text-decoration: none; color: #007bff;">Register</a></p>
        </form>
    </div>
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

</body>

</html>