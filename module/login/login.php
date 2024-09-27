<?php
include '../condb.php';
include '../session.php';

$username_or_email = $_POST['email/username'];
$password = $_POST["password_log"];
$hash_pass = hash('sha256',$password);

// ค้นหาผู้ใช้ในฐานข้อมูลโดยใช้ชื่อผู้ใช้หรืออีเมล
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username ");
$stmt->execute(['username' => $username_or_email]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$pass_hash= $result['password'];
$statud = $result['statud'];
$user = $result['username'];

if ($result) {    
    if($hash_pass == $pass_hash){
        $user = $result['username'];
        $statud = $result['statud'];
       
        createsession($user,$statud);

        if (isset($_SESSION['user_name'])){
            header('location: ../../view/home.php')  ;
            echo'<script>window.location="../../view/home.php"</script>';
        } else{
            echo'<script>window.location="../../view/ui_login/Ui_login.php"</script>';
        }
    }
    else {
        echo'<script>alert("password incorect please try again")</script>';
        echo'<script>window.location="../../view/ui_login/Ui_login.php"</script>';
    }
}else{
    echo'<script>window.location="../../view/ui_login/Ui_login.php"</script>';
}
?>
