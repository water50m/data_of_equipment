<?php
$servername = 'localhost';
$username = 'root';
$password = '56585452qerZ';
$database = 'newwork1';
$conn = mysqli_connect($severname,$username,$password,$database);

$pdo = new PDO("mysql:host=$servername;dbname=$database", "$username", "$password");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->exec("SET CHARACTER SET utf8");  
// echo 'con db <br>';
if(!$pdo or !$conn){
    // echo 'con db <br>';
    die("Connection failed: " . mysqli_connect_error());
}else{
    // echo 'con db <br>';
}


?>