<?php
include '../condb.php';

$id=$_GET['id'];



$sql = "SELECT * FROM equipment_inspection_report WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);




$dataString = $row["Item"];

$del = "DELETE FROM equipment_inspection_report WHERE id='$id'";




if(mysqli_query($conn, $del) ) {

    
    $filename = $row['image'];
    $part="../../img/".$filename;

    unlink($part);
    session_start();
    $user = $_SESSION['user_name'];
    include '../save_history.php';
    saveToHistory("Delete item", $dataString,$user);
    echo "<script>alert('Deleted data already');</script>";
    echo "<script>window.location='../../view/Equepment.php';</script>";
}else{
    
    echo "Error: " . '</br>' . mysqli_error($conn);
    echo "<script>alert('Cant delete data');</script>";
    
}

mysqli_close($conn);
?>