<?php
include 'condb.php';
$page = $_GET['id'];
$newtype = $_POST['newtype'];

if (!empty($newtype)){
$sql = "INSERT INTO type1(type_name) VALUE('$newtype')";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('Save data success!');</script>";
    session_start();
    $user = $_SESSION['user_name'];
    include "save_history.php";
    $note = "Add type ".$newtype;
    saveToHistory("Add new type",$nawtype,$user,$note);



    if($page ){
        echo "<script>window.location='../view/edit_product.php?id=$page'; </script>";
    }
    else{
        echo "<script>window.location='../view/fr_product.php'; </script>";
        }
}else{
    echo "<script>alert('Save data failed!');</script>";
    die("SQL query failed: " . mysqli_error($conn));
}
}else{
    echo "<script>window.location='../view/edit_product.php?id=$page'; </script>";
}
?>