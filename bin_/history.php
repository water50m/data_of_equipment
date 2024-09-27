<?php
session_start();
if (isset($_SESSION['user_name'])){
include '../module/condb.php';
$sql = "SELECT * FROM history";
$resulte = mysqli_query($conn,$sql);
?>


้<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include '../navbar/navbar.php'; ?>
</head>
<body>

<div class="container col-sm-8 mt-0">
<div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">Product data</div>
<?php
     $rows = array_reverse(mysqli_fetch_all($resulte, MYSQLI_ASSOC));
       foreach($rows as $row) {
            echo $row['Date_T'].'<br>';
            echo $row['what_do'].'<br>';
            echo $row['what_was'].'<br>';
            echo $row['note_hs'].'<br>';
            echo '==========================================================================================<br>';
        }
    ?>
</div>
    
</body>
</html>
<?php
}else{
    header('location: ui_login/Ui_login.php') ;
}
?>