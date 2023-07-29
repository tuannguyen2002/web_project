<?php
    session_start();
    $user = $_POST['username'];
    $pass = $_POST['pass'];
    
    $conn = new mysqli('localhost', 'root', '', 'first_project');
    
    $query = "SELECT * FROM user_data WHERE username = '$user'";
    $result = $conn->query($query)->fetch_assoc();
    
    if($result['pass'] == $pass)
    {
        header("location:page1.php");
    }
    else{
        $_SESSION['login-fail'] = "<b>Incorrect Username or Password!</b>";
        header("location:login.php");
    }   
    mysqli_close($conn);
    ?>