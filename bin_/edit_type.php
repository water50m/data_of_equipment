<?php
include 'condb.php';
session_start();
$id = $_POST['selected'];
$page = $_SESSION['page'];
$newname = $_POST['newnametype'];




if (!empty($newname) ){
$sql = "SELECT * FROM type1 WHERE type_id = '$id'";
$oldname = mysqli_query($conn,$sql);
$old_name = mysqli_fetch_array($oldname);
$name = $old_name['type_name'];

$sql = "UPDATE type1 set type_name='$newname' WHERE type_id='$id'";
$result = mysqli_query($conn,$sql);

$hs = "INSERT INTO history(what_do, what_was) VALUES ('$hs_ac','$id')";
$note1 = 'Change name of type from '.$name ;
$note2 = ' to '.$newname;
$totalnote = $note1.$note2;
$user = $_SESSION['user_name'];
$idtype = "Type ID: ".$id.'.';
include 'save_history.php';
saveToHistory("Edit type", $idtype,$user,$totalnote);

if($result){
    echo "<script>alert('Edit data already!');</script>";
    if($page =='add'){
        echo "<script>window.location='../view/fr_product.php'; </script>";
        unset($_SESSION['page']);
    }else {
        
        echo "<script>window.location='../view/edit_product.php?id=$page'; </script>";
        unset($_SESSION['page']);
    
    }
}else{
    echo "<script>alert('Cant edit data!');</script>";
}
}else{
    echo "<script>window.location='../view/edit_product.php?id=$page'; </script>";
}
mysqli_close($conn);
?>