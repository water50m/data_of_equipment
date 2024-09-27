<?php
include '../module/condb.php';

session_start();
$idUser = $_GET['id'];
$page = $_SESSION['page'];
// echo'id is: '.$idUser;
// echo'<br>session nmame is: '.$_SESSION['user_name'];
// echo'<br>session status is: '.$_SESSION['user_statud'];
if ($_SESSION['user_name'] and (($_SESSION['user_statud'] == 0))) {
include 'modal.php';  




$sql1  = "SELECT * FROM users WHERE id='$idUser'";
$result=mysqli_query($conn,$sql1);
$rs=mysqli_fetch_array($result);


$std = $rs['statud'];
echo'status is: '.$std.'';
$i =0;

if($std == '0'){
    $status1 = 'Admin';
}if($std == '1'){
    $status1 = 'High level user';
}if($std == '2'){
    $status1 = 'User';
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.rtl.min.css" >
    <script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Edit product</title>
</head>
<body>
<?php include '../navbar/navbar.php'; ?>

    <div class="container col-sm-6">
        <div class="row">
        <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">Edit product data</div>
            <div class="col-6">
            

                <form name="form1" method="post" action="../module/edit_user.php" enctype="multipart/form-data">
                    <div class="form">
                    
                <input type="hidden" name="Uid" class="form-control"  value="<?=$rs['id']?> ">
                
                    <label>Username</label>
                    <input type="text" name="Uname" class="form-control"  value="<?=$rs['username']?> "><br>

                    <label>Email</label>
                    <input type="text" name="Uemail" class="form-control"  value="<?=$rs['email']?>"><br>

                    <label>Tel.</label>
                    <input type="text" name="Uphone" class="form-control"  value="<?=$rs['phone']?>"><br>

                    <label>Status</label>  
                    <!-- <a    href="" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">[+]</a> -->
                    <select class="form-select" aria-label="Default select example" name="std">
                        <option selected value="<?=$rs['statud']?>"><?=$status1?></option>
                                <?php
                                 
                    while($i <=2 ){if($i == $rs['statud']){}else{
                        if($i == 0){
                            $statud = "Admin";
                        }else if($i == 1){
                            $statud = "High level user";
                        }else{
                            $statud = "User";
                        }
                        ?>
                        <option value="<?=$i?>"><?=$statud?></option>
                    <?php                    
                    }
                    $i++;
                    }
                    ?>                        
                        </select>

                    <button type="submit" class="btn btn-success mt-4">Save</button>
                    <a href="show_user.php" class="btn btn-primary mt-4" type="reset" value="Cancle">Back</a>
                    </div>
                    </form>

            </div>
            <div class="col-6 text" style="position:relative; bottom:0;">
            <form name="form1" method="post" action="../module/edit_user.php" >
            <label>Reset password</label>
            <input type="hidden" name="Uid" class="form-control"  value="<?=$rs['id']?> ">
                    <input type="text" name="Unewpassword" class="form-control" placeholder="New password" ><br>
                    <input type="text" name="Uconnewpassword" class="form-control" placeholder="Confirm password" >
                <button type="submit" class="btn btn-success mt-4">Reset</button>
            </div>
            </form>

        </div>


    </div>


<!-- ----------------------------------------------modal---------------------------------------------------------------------------------- -->

<!-- Modal -->


</body>
</html>
<?php
}else{
  header('location: ui_login/Ui_login.php')  ;
}

?>