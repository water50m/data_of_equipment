<?php
include '../condb.php';

// ดึงข้อมูลที่ผู้ใช้กรอกจากแบบฟอร์มการลงทะเบียน
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];

$checkQueryEmail = "SELECT email FROM users WHERE email = '$email'";
$checkEmail = mysqli_query($conn, $checkQueryEmail);

$checkQueryUsername = "SELECT username FROM users WHERE username = '$username'";
$checkUsername = mysqli_query($conn, $checkQueryUsername);

if (mysqli_num_rows($checkEmail)  ) {
    echo "<script>alert('Email address is already registered. Please use a different email.');</script>";
} elseif (mysqli_num_rows($checkUsername)) {
    echo "<script>alert('Username is already registered. Please use a different  Username.');</script>";
}else{
    $hash_pass = hash('sha256',$password);
    $data = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hash_pass')";
    $result = mysqli_query($conn, $data);
    
    if ($result) {
        echo "<script>alert('Success registeration.');</script>";
        echo "<script>window.location='../../view/ui_login/Ui_login.php'</script>";
    } else {
        echo "<script>alert('Registration failed. Please try again.');</script>";
    }
}
?>
