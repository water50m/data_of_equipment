<?php
include('../condb.php');
include("../function/send_email.php");
session_start();

$email = $_SESSION["email"];
// echo"email: ".$email;
// $email = 'lobalkobabalo@gmail.com';

$sql = "SELECT * FROM reset_password WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0) {
    // Email already exists, update the OTP
    $otp = rand(100000, 999999);
    $timestamp = date("Y-m-d H:i:s");
    $updateSql = "UPDATE reset_password SET otp = ?, date = ? WHERE email = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("iss", $otp, $timestamp, $email);
    
    if($updateStmt->execute()) {
        $message = "Your new OTP for password reset is: $otp";
    
        if (sent_mail('Reset password', $email, 'Hi', $message) === true) {
            header("refresh:5;url=../../view/ui_login/Ui_inputOTP.php"); 
        } else {
            echo "Please check your email"."<br>loading...";
            echo "Can't sent email. please check your email again."."<br>loading...";
            header("refresh:5;url=../../view/ui_login/Ui_forgot_password.php");
            unset($_SESSION["email"]);
            exit();
        }
        header("refresh:
        
        ;url=../../view/ui_login/Ui_inputOTP.php"); 
    } else {
        unset($_SESSION["email"]);
        header("refresh:1;url=../../view/ui_login/Ui_forgot_password.php");
    }
} else {
    // Email doesn't exist, proceed with insert
    $otp = rand(100000, 999999);
    $timestamp = date("Y-m-d H:i:s");
    $insertSql = "INSERT INTO reset_password (email, otp, date) VALUE (?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("sis", $email, $otp, $timestamp);
    
    if($insertStmt->execute()) {
        $message = "Your OTP for password reset is: $otp";
    
        if (sent_mail('Reset password', $email, 'Hi', $message) === true) {
            header("refresh:5;url=../../view/ui_login/Ui_inputOTP.php"); 
        } else {
            echo "Please check your email"."<br>loading...";
            echo "Can't sent email. please check your email again."."<br>loading...";
            header("refresh:5;url=../../view/ui_login/Ui_forgot_password.php");
            unset($_SESSION["email"]);
            exit();
        }
        header("refresh:1;url=../../view/ui_login/Ui_inputOTP.php"); 
    } else {
        unset($_SESSION["email"]);
        header("refresh:1;url=../../view/ui_login/Ui_forgot_password.php");
    }
}
?>
