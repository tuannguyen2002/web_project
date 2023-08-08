<?php
    session_start();
        function is_valid_password($password) {
            // Kiểm tra mật khẩu có ít nhất 6 ký tự
            if (strlen($password) < 8) {
                return false;
            }
        
            // Kiểm tra mật khẩu có chứa ít nhất một chữ cái và một số
            if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
                return false;
            }
        
            return true;
        }

        $conn=mysqli_connect("localhost","root","","first_project");
        if(!$conn){
            die ('Ket noi khong thanh cong: '.mysqli_connect_error());
        }

        if(isset($_POST['submit']) && $_POST['username'] != '' && $_POST['pass'] != '' && $_POST['confirm-password'] != '' && $_POST['firstname'] != '' && $_POST['lastname'] != '')
        {
            $user = $_POST['username'];
            $pass = $_POST['pass'];
            $first = $_POST['firstname'];
            $last = $_POST['lastname'];
            $confpass = $_POST['confirm-password'];

            if($pass == $confpass)
            {
                if (is_valid_password($pass))
                {
                    $queryCheckUser = "SELECT * FROM user_data WHERE username = '$user'";
                    $resultCheckUser = mysqli_query($conn, $queryCheckUser);
                    // $pass = md5($pass);
                    if(mysqli_num_rows($resultCheckUser)>0)
                    {
                        $_SESSION['same_user'] = "Username already used. Try again!";
                        header("location:register.php");
                        exit();
                    }
        
                    //Chức năng xác nhận email
                    // else
                    // {
                    //     $_SESSION['registered_username'] = $user;
                    //     $_SESSION['registered_pass'] = $pass; 
                    //     header("location:signup-verify.php");
                    //     exit();
                    // }
                    $query = "INSERT INTO user_data (username, pass, firstname, lastname) VALUES ('$user', '$pass', '$first', '$last')";
                    $result = mysqli_query($conn, $query);
                    if($result)
                    {
                        $_SESSION['success_message'] = "Account created successfully!";
                        $_SESSION['registered_username'] = $user; // Lưu tên tài khoản đã đăng ký
                        $_SESSION['registered_pass'] = $pass; 
            
                        header("Location: login.php");
                    }else{
                        echo "Some thing Wrong!";
                    }
                }
                else{
                    $_SESSION['signup-fail'] = "Password must be at least <b>8 characters</b>, <br>
                                                Include both <b>letters</b> and <b>numbers</b>.";
                    $_SESSION['email'] = $user;
                    $_SESSION['first'] = $first;
                    $_SESSION['last'] = $last;
                    echo "<script>window.location.href='register.php';</script>";
                    exit();
                }
            }
            else{
                echo '<p id="checkmatchpass">Confirm password does not match password. Please check!</p>';  
            }
        }
    ?>
    <?php
        mysqli_close($conn);
    ?>