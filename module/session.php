<?php 
session_start();

function createsession($user,$statud){
    $_SESSION['user_name']= $user;
    $_SESSION['user_statud'] = $statud;

}
function showsession(){
    $name = $_SESSION['user_name'];
    $statud = $_SESSION['user_statud'];
    echo 'session : '.$name.'<br>';
    echo 'value : '.$statud;
}
function closesession(){
    unset($_SESSION['user_name']);
    unset($_SESSION['user_statud']);
    session_destroy();
}
?>