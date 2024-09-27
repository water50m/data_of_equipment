<?php
session_start();
$name = $_SESSION['user_name'];
$statud = $_SESSION['user_statud'];
echo 'session : '.$name.'<br>';
echo 'value : '.$statud;


// include 'session.php';
// closesession();
// header('location:../view/home.php')
if (isset($_SESSION['user_name'])){

if ($statud == 0) {
    // ผู้ใช้เข้าสู่ระบบ
    // ดำเนินการตามที่คุณต้องการ
    echo'yes';
} else {
    // ผู้ใช้ยังไม่ได้เข้าสู่ระบบ
    // ดำเนินการตามที่คุณต้องการ
    echo'no';
}
}else{
    echo 'no session';
}
?>
