<?php
include '../condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newpass = $_POST['newpass'];
    $conpass = $_POST['conpass'];
    
    session_start();
    $getmail =  $_SESSION["email"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email'=> $getmail]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        
        if($newpass == $conpass){
            $hash_new_pass = hash('sha256', $newpass);
            $stmt = $pdo->prepare("UPDATE users  SET password = :newpassword  WHERE email = :email");
            $stmt->bindParam(':newpassword' ,$hash_new_pass );
            $stmt->bindParam(':email' ,$getmail );
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                unset($_SESSION['email']);
                // echo "Record updated successfully.";
                header("Location:../../view/ui_login/Ui_login.php");
            } else {
                echo "<script>alert(Something wrong about database.)</script>";
                header("Location:C:..\..\view\ui_login\Ui_enter_new_password.php");
            }
        }else{
            echo "<script>alert(Password doesn't match.)</script>";
                    header("Location:C:..\..\view\ui_login\Ui_enter_new_password.php");

        }
    }else{
        echo "<script>alert(Can't find your email.)</script>";
                header("Location:C:..\..\view\ui_login\Ui_enter_new_password.php");
    }

}
?>