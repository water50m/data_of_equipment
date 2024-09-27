<?php
include('condb.php');
$id=$_GET['id'];
echo''.$id.'';

// $sql = "SELECT * FROM users WHERE type_id='$id'";
// $result= mysqli_query($conn,$sql);
// $type = mysqli_fetch_array($result);
// $type_name =$type['type_name'];

if(!empty($id)){

$del = "DELETE FROM users WHERE id='$id'";


if(mysqli_query($conn, $del) ) {
    // session_start();
    // include 'save_history.php';
    // $user = $_SESSION['user_name'];
    // $dataString = implode(' ', array('Delete type name '.$type_name, ' from database. '));

    // $id_pro = "Type ID: ".$id;

    // saveToHistory("Delete type", $id_pro,$user,$dataString );
    echo "<script>alert('Deleted type already');</script>";
    echo "<script>window.location='../view/show_user.php';</script>";
}else{
    echo "Error: " . $sql . '</br>' . mysqli_error($conn);
    echo "<script>alert('Cant delete user');</script>";
    
}

mysqli_close($conn);
}else{
    echo "<script>alert('Please select user');</script>";
    echo "<script>window.location='../view/show_user.php';</script>"; 
}
?>