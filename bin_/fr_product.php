<?php
include '../module/condb.php';
session_start();

$_SESSION['page']= 'add';

if(!isset($_SESSION['user_name'])){
  header('location:ui_login/Ui_login.php');
}else{
  



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
    
    <title>Add product</title>
</head>
<body>
<?php include '../navbar/navbar.php'; ?>
    <div class="container col-sm-6">
        <div class="row">
            <div class="col">
            <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">Add product data</div>

                <form name="form1" method="post" action="../module/insert_product.php" enctype="multipart/form-data">

                    <label>Product name</label>
                    <input type="text" name="Pname" class="form-control" placeholder="product name..." required><br>
                    
                    <label>Product type</label> <a href="" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#exampleModal">[+]</a>
                    <select class="form-select" name="typeid">
                    <?php
                    $sql  = "SELECT * FROM type1 ORDER BY type_name";
                    $hand=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($hand)){
                      
                    ?>
                    <option value="<?=$row['type_id']?>"><?=$row['type_name']?></option>
                    <?php
                    }
                    ?>
                    </select>
                    
                    <label>Price</label>
                    <input type="number" name="Pprice" class="form-control" placeholder="price..." require pattern="[0-9]">
                    <label>Amount</label>
                    <input type="number" name="Pamount" class="form-control" placeholder="amount..." required >
                    <label>Location</label>
                    <input type="text" name="Plocation" class="form-control" placeholder="location..." require>
                    <label>Note</label>
                    <input type="text" name="Pnote" class="form-control" placeholder="note..." required >
                    
                    <label>Image</label>
                    <input type="file" name="filename" class="form-control" required>
                    
                    
                    
                    <button type="submit" class="btn btn-success mt-4">Save</button>
                    <a href="show_product.php" class="btn btn-primary mt-4" type="reset" value="Cancle">Back</a>
                    </form>

            </div>

        </div>


    </div>


<!-- ----------------------------------------------modal---------------------------------------------------------------------------------- -->

<!-- Modal -->
<?php
include 'modal.php';
?>
</body>
</html>
<?php
}
?>