<?php
    session_start();
    $sameUser = isset($_SESSION['same_user']) ? $_SESSION['same_user'] : '';
    $signupFail = isset($_SESSION['signup-fail']) ? $_SESSION['signup-fail'] : '';
    $user_checkPass = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $first_checkPass = isset($_SESSION['first']) ? $_SESSION['first'] : '';
    $last_checkPass = isset($_SESSION['last']) ? $_SESSION['last'] : '';
    unset($_SESSION['same_user']);
    unset($_SESSION['signup-fail']);
    unset($_SESSION['email']);
    unset($_SESSION['first']);
    unset($_SESSION['last']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Sign Up</title>
</head>

<body>
    <?php if (!empty($sameUser)): ?>
        <div class="sameUser-noti">
            <?php echo $sameUser; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($signupFail)): ?>
        <div class="signup-fail">
            <?php echo $signupFail; ?>
        </div>
    <?php endif; ?>
    
    <div class='light x1'></div>
    <div class='light x2'></div>
    <div class='light x3'></div>
    <div class='light x4'></div>
    <div class='light x5'></div>
    <div class='light x6'></div>
    <div class='light x7'></div>
    <div class='light x8'></div>
    <div class='light x9'></div>
    
    <form method = "POST" class="form-signup" action = "signup-action.php">  
        <h2>Sign Up</h2>

        <div class = "name">
            <div class = "first_name">
                <label for="firstname">First Name*</label>
                <input type="text" id="firstname" placeholder="Enter first name" name="firstname" value = "<?php echo $first_checkPass; ?>" required>
            </div>

            <div class = "last_name">
                <label for="lastname">Last Name*</label>
                <input type="text" id="lastname" placeholder="Enter last name" name="lastname"value = "<?php echo $last_checkPass; ?>" required>
            </div>
        </div>

        <label for="username">Email*</label>
        <input type="email" placeholder="Enter your Email" id="username" autocomplete="off" name = "username" value = "<?php echo $user_checkPass; ?>" required>

        <label for="password">Password*</label>
        <input type="password" id = "pass" placeholder="Must be between 8 and 30 characters" id="password" name = "pass" required>

        <label for="confirm-password" id="confirm-password-label">Confirm Password*</label>
        <input type="password" id = "confpass" placeholder="Confirm your password" id="confirm-password" name = "confirm-password" required>
        <p id="checkmatchpass">Confirm password does not match password. Please check!</p>

        <button type="submit" name = "submit" class="signup" onclick = "SignUp()">Sign Up</button><br><br> 
        <div class = "BackToSignIn"><b>Already have an Account?</b><button type="button" class="back"><u><b><a href="login.php">Sign In</a></b></u></button></div>
    </form>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            var pass = document.querySelector('input[name="pass"]').value;
            var confpass = document.querySelector('input[name="confirm-password"]').value;
            var checkmatchpass = document.getElementById('checkmatchpass');

            if (pass !== confpass) {
                // Hiển thị thông báo nếu password và confirm password không khớp
                checkmatchpass.style.display = 'block';
                event.preventDefault(); // Ngăn form gửi đi nếu thông báo hiển thị
            } else {
                // Ẩn thông báo nếu password và confirm password khớp
                checkmatchpass.style.display = 'none';
            }
        });
    </script>
</body>

</html>
