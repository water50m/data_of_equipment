<?php
include '../condb.php';



$username_or_email = $_POST['email/username'];
$password = $_POST["password_log"];
$hash_pass = hash('sha256',$password);
// echo $hash_pass."<br>";
// echo $username_or_email ."<br>";
// echo $password ."<br>";
// echo 'int'.hash('sha256',1234)."<br>";
// echo 'str'.hash('sha256','1234')."<br>";
// echo $pass_hash."<br>";
    // ค้นหาผู้ใช้ในฐานข้อมูลโดยใช้ชื่อผู้ใช้หรืออีเมล
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username ");
$stmt->execute(['username' => $username_or_email]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$pass_hash= $result['password'];

if ($result) {    
    if($hash_pass == $pass_hash){
        $usernamecookie = $result['username'];
        $statud = $result['statud'];

        include '../cookie.php';
        addcookie($usernamecookie  ,$statud);

        if (checkcookie($usernamecookie ) == True){

        // echo 'success'; 
        // header('../../view/home.php')  ;
        echo'<script>window.location="../../view/home.php"</script>';
         
        } else{
            echo'<script>window.location="../../view/ui_login/Ui_login.php"</script>';
            
        }
    }
    else {
        echo'<script>alert("password incorect please try again")</script>';
        echo'<script>window.location="../../view/ui_login/Ui_login.php"</script>';
        
    }
}
else{

}

?>
