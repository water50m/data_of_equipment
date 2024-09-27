<?php
include '../module/condb.php';

session_start();

$page = $_SESSION['page'];

if (isset($_SESSION['user_name'])) {
include 'modal.php';  



$idpro = $_GET['id'];


$sql1  = "SELECT * FROM product WHERE pro_id='$idpro' ";
$result=mysqli_query($conn,$sql1);
$rs=mysqli_fetch_array($result);
$rsid  =$rs['type_id'];

$sql3 = "SELECT * FROM type1 WHERE type_id='$rsid'";
$hand3=mysqli_query($conn,$sql3);
$rs3=mysqli_fetch_array($hand3);   
$rsid2  =$rs3['type_name'];
       
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
            <div class="col">
            <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">Edit product data</div>

                <form name="form1" method="post" action="../module/update_pro.php" enctype="multipart/form-data">

                    <label>Product id</label>
                    <input type="text" name="Pid" class="form-control"  readonly value="<?=$rs['pro_id']; $_SESSION['page']= $rs['pro_id'];?> "><br>

                    <label>Product name</label>
                    <input type="text" name="Pname" class="form-control"  value="<?=$rs['pro_name']?>"><br>

                    <label>price</label>
                    <input type="text" name="Pprice" class="form-control"  value="<?=$rs['price']?>"><br>

                    <label>Amount</label>
                    <input type="number" name="Pamount" class="form-control"  value="<?=$rs['amount']?>"><br>

                    <label>Location</label>
                    <input type="text" name="Plocation" class="form-control" value="<?=$rs['location']?>" >
                    <label>Note</label>
                    <input type="text" name="Pnote" class="form-control" value="<?=$rs['Note']?>"  >
                    
                    <label>Product type</label>  <a href="" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">[+]</a>
                    <select class="form-select" name="typeid">
                    <option value="<?=$rs3['type_id']?>"><?=$rs3['type_name']?></option>
                    <?php
                    $sql  = "SELECT * FROM type1 ORDER BY type_name";
                    $hand=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($hand)){
                        if($rs3['type_name'] == $row['type_name']){}else{
                    ?>
                        <option value="<?=$row['type_id']?>"><?=$row['type_name']?></option>
                    <?php
                        }
                    }
                    ?>
                    </select>
                    
                   
                    
                    <label>Image</label>
                    <input type="file" name="filename" class="form-control" >
                    

                    <button type="submit" class="btn btn-success mt-4">Save</button>
                    <a href="show_product.php" class="btn btn-primary mt-4" type="reset" value="Cancle">Back</a>
                    </form>

            </div>

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