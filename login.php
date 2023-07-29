<?php
    session_start();
    $successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
    $registeredUsername = isset($_SESSION['registered_username']) ? $_SESSION['registered_username'] : '';
    $loginfail = isset($_SESSION['login-fail']) ? $_SESSION['login-fail'] : '';
    unset($_SESSION['success_message']); // Xóa thông báo sau khi đã hiển thị
    unset($_SESSION['login-fail']);
    unset($_SESSION['registered_username']); // Xóa tên tài khoản sau khi đã điền vào trường tài khoản
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <script src = "script.js"></script>

    <div class='light x1'></div>
    <div class='light x2'></div>
    <div class='light x3'></div>
    <div class='light x4'></div>
    <div class='light x5'></div>
    <div class='light x6'></div>
    <div class='light x7'></div>
    <div class='light x8'></div>
    <div class='light x9'></div>
    
    <form method = "POST" class="form-signin" action = "login-action.php">
        <h2>Login</h2>

        <label for="username">Email</label>
        <input type="email" placeholder="Email" id="username" name = "username" autocomplete="off" value = "<?php echo $registeredUsername;?>" required>

        <label for="pass">Password</label>
        <input type="password" placeholder="Password" id="pass" name = "pass" required>

        <button type="submit" class="signin" onclick = "SignIn()">Login</button><br><br>
        <div class = "goToSignUp"><b>Do not have acount? </b><a href="signup.php" class = "next"><b>Sign Up</b></a></div>
    </form>

    <?php if (!empty($successMessage)): ?>
        <div class="success-notification">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($loginfail)): ?>
        <div class="loginFail-noti">
            <?php echo $loginfail; ?>
        </div>
    <?php endif; ?>

</body>
</html>