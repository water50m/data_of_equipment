<?php
include ('condb.php');
include('connectPTtable.php');
$id=$_GET['id'];
$sql = "SELECT * FROM product WHERE pro_id = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);


$type_name = TypeidToname($row['$type_id']);

$dataString = implode(' ', array('ID: '.$row['pro_id'],'name: '.$row['pro_name'], ' type: '.$type_name, ' price: '.$row['price'], ' amount: '.$row['amount'], ' location: '.$row['location'], ' note: '.$row['Note']));

$del = "DELETE FROM product WHERE pro_id='$id'";




if(mysqli_query($conn, $del) ) {
    $filename = $row['image'];
    $part="../img/".$filename;

    unlink($part);
    session_start();
    $user = $_SESSION['user_name'];
    include 'save_history.php';
    saveToHistory("Delete item", $type_name,$user,$dataString);
    echo "<script>alert('Deleted data already');</script>";
    echo "<script>window.location='../view/show_product.php';</script>";
}else{
    echo "Error: " . $sql . '</br>' . mysqli_error($conn);
    echo "<script>alert('Cant delete data');</script>";
    
}

mysqli_close($conn);
?>