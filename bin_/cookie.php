<?php

function addcookie($cookie_value){

$cookietime = time() + (1800);
setcookie('page', $cookie_value,$cookietime , "/"); 

// echo "<script>alert('$cookie_name $cookie_value')</script>";
}

function checkcookie($cookiename){
    
    if(!isset($_COOKIE[$cookiename])) {
        echo "Cookie named ' . $cookiename . ' is not set!";
        return False;
        
      } else {
        
        // echo "Cookie '" . $cookiename . "' is set!<br>";
        // echo "Value is: " . $_COOKIE[$cookiename];
        return True;
      }
    }

function cookieenabled($cookiename){
    if(count($_COOKIE[$cookiename]) > 0) {
        echo "Cookies are enabled.".$_COOKIE[$cookiename].'<br>';
      } else {
        echo "Cookies are disabled.".'<br>';
      }
}

function cookieenabled2(){
    if (isset($_COOKIE)) {
        // วนลูปผ่านคุกกี้ทั้งหมดและแสดงชื่อของคุกกี้
        foreach ($_COOKIE as $cookie_name => $cookie_value) {
            echo "ชื่อคุกกี้: " . $cookie_name . "<br>";
            echo "ค่าคุกกี้: " . $cookie_value . "<br>";
        }
    } else {
        echo "ไม่มีคุกกี้ในรีเควสท์นี้";
    }
}

function delcookie($cookiename){
    setcookie($cookiename, "", time() - 3600);
    echo 'del cookie';
}
?>