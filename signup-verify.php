<?php
    session_start();
    $registeredUsername = isset($_SESSION['registered_username']) ? $_SESSION['registered_username'] : '';
    $registeredPassword = isset($_SESSION['registered_pass']) ? $_SESSION['registered_pass'] : '';
    unset($_SESSION['registered_username']);
    unset($_SESSION['registered_pass']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

    // Hàm để gửi email xác nhận
    function sendConfirmationEmail($email, $confirmationCode) {
        // Khởi tạo đối tượng PHPMailer
        $mail = new PHPMailer;

        // Cấu hình thông tin máy chủ SMTP của Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = 'coixaygio@gmail.com'; // Thay bằng tài khoản Gmail của bạn
        $mail->Password = 'pfmmzsqyserujpzg'; // Thay bằng mật khẩu Gmail của bạn

        // Thiết lập email gửi và nhận
        $mail->setFrom('coixaygio107@gmail.com', 'Administrator'); // Thay bằng tài khoản Gmail của bạn và tên của bạn
        $mail->addAddress($email); // Sử dụng địa chỉ email của người nhận từ tham số truyền vào
        // Để gửi email cho người nhận, ta không cần thiết lập tên của người nhận (Recipient Name)

        // Thiết lập nội dung email
        $mail->Subject = 'Xác nhận đăng ký tài khoản';
        $mail->Body = "Chào bạn,\nMã xác nhận của bạn là: $confirmationCode";

        // Gửi email
        if ($mail->send()) {
            echo 'Đã gửi email xác nhận thành công!';
        } else {
            echo 'Có lỗi xảy ra khi gửi email xác nhận: ' . $mail->ErrorInfo;
        }
    }

    // Hàm để tạo mã xác nhận ngẫu nhiên
    function generateConfirmationCode($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($characters), 0, $length);
    }

    // Giả sử người dùng đã cung cấp email và thông tin đăng ký trong bước 1
    $userEmail = $registeredUsername;
    $userPass = $registeredPassword;

    // Tạo mã xác nhận mới
    $confirmationCode = generateConfirmationCode();

    $conn=mysqli_connect("localhost","root","","first_project");
    if(!$conn){
        die ('Ket noi khong thanh cong: '.mysqli_connect_error());
    }

    // Lưu thông tin tạm thời vào cơ sở dữ liệu
    $query = "INSERT INTO temporary_user_data (username, pass, number_verify) VALUES ('$userEmail', '$userPass', '$confirmationCode')";
    $result = mysqli_query($conn, $query);
    if ($conn->query($query) === TRUE) {
        echo "Đã lưu thông tin tạm thời vào cơ sở dữ liệu thành công!";
    } else {
        echo "Lỗi khi lưu thông tin tạm thời vào cơ sở dữ liệu: " . $conn->error;
    }

    // Gửi email xác nhận đến địa chỉ email của người dùng
    sendConfirmationEmail($userEmail, $confirmationCode);
    ?>


    <form method = "POST" class="form-signin" action = "">
        <h2>Email Verification</h2>

        <p>A code with 6 characters has been sent to your Email. <br>
        Please enter it here and click "Verify" to complete the registration</p>

        <input type="email" placeholder="Enter your Email" id="username" autocomplete="off" name = "username" value = "<?php echo $registeredUsername;?>" required>

        <input type="password" id = "pass" placeholder="Must be between 8 and 30 characters" id="password" name = "pass" value = "<?php echo $registeredPassword;?>" required>

        <label for="number_verify">Enter verification codes here</label>
        <input type="text" id = "number_verify" id="number_verify" name = "number_verify" required>

        <button type="submit" class="signin_verify">Login</button><br><br>
    </form>
</body>
</html>