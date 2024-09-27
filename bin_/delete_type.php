<?php
include('condb.php');
$id=$_POST['typeid'];


$sql = "SELECT * FROM type1 WHERE type_id='$id'";
$result= mysqli_query($conn,$sql);
$type = mysqli_fetch_array($result);
$type_name =$type['type_name'];



$del = "DELETE FROM type1 WHERE type_id='$id'";


if(mysqli_query($conn, $del) ) {
    session_start();
    include 'save_history.php';
    $user = $_SESSION['user_name'];
    $dataString = implode(' ', array('Delete type name '.$type_name, ' from database. '));

    $id_pro = "Type ID: ".$id;

    saveToHistory("Delete type", $id_pro,$user,$dataString );
    echo "<script>alert('Deleted type already');</script>";
    echo "<script>window.location='../view/show_product.php';</script>";
}else{
    echo "Error: " . $sql . '</br>' . mysqli_error($conn);
    echo "<script>alert('Cant delete type');</script>";
    
}

mysqli_close($conn);
?>