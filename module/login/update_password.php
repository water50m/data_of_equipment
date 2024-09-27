<?php
namespace newwork2;
use PDO;
use PDOException;

include("../../module/condb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['Confirm_New_Password'];

    if ($new_password === $confirm_password) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $user_email = $_SESSION['user_email'];
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // ค้นหาผู้ใช้โดยใช้ email
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch();

            if ($user) {
                // ทำการอัปเดต password ใหม่
                $stmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :email");
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                echo "<script>alert('Password updated successfully. Redirecting to login page...');</script>";
                header("Location: ../../view/ui_login/Ui_login.php");
                exit;
            } else {
                echo "<script>alert('User not found');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Connection failed: " . $e->getMessage() . "');</script>";
        
        }
    } else {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
        header("Location: ../../view/ui_login/Ui_reset_password.php");
    exit;

    }
}
?>
