<?php
include ("condb.php");
$id = $_POST['Uid'];
$Uname = $_POST['Uname'];
$Uemail = $_POST['Uemail'];
$Uphone = $_POST['Uphone'];

$std = $_POST['std'];
$RePass = $_POST['Unewpassword'];
$ConRePass = $_POST['Uconnewpassword'];

echo 'status is: '.$std;

echo '<br>uid is: '.$Uname;
if(!empty($Uname)){
$data = "UPDATE users SET username = '$Uname', email = '$Uemail', phone = '$Uphone', statud = '$std' WHERE id = $id";

$result = mysqli_query($conn,$data);
if($result){
    echo "<script>alert('Success!')</script>";
    echo"<script>window.location = '../view/show_user.php?id=$id'</script>";
}else{
    echo "<script>alert('Fail!')</script>";
    echo mysqli_error( $conn );
    // echo"<script>window.location = '../view/edit_user.php?id=$id'</script>";
}
}else if(!empty($RePass) and !empty($ConRePass)){
    if($RePass == $ConRePass){
        $hash_pass = hash('sha256',$RePass);
        $sql = "UPDATE users set passsword = '$hash_pass' WHERE id ='$id'";
        $result = mysqli_query($conn,$sql);
        if($result){
        echo "<script>alert('Reset password already!')</script>";
        
        echo"<script>window.location = '../view/show_user.php?id=$id'</script>";
        }else{
            echo '<script>alert("Cant reset password.")</script>';
            header ("location:../view/edit_user.php?id=$id "); 
        }
    }else{
        echo "<script>alert('Password is not match!')</script>";
        header ("location:../view/edit_user.php?id=$id "); 
    }
}else{
    echo "<script>alert('Please fill username.')</script>";
    echo"<script>window.location = '../view/edit_user.php?id=$id'</script>";
}
?>