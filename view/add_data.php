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
    <div class="container ">
        <div class="row">
            <div class="col">
            <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">Add product data</div>

                <form name="form1" method="post" action="../module/data/insert_equepment.php" enctype="multipart/form-data">
                <div class="container ">
                <div class="row">
                    <div class="col">
                    <label style="margin-bottom:7px;">1. Item name</label>
                    <input type="text" name="name" class="form-control" placeholder="Item name..." ><br>
                    <label style="margin-bottom:7px;">2. Type</label><a href="" data-bs-toggle="modal" data-bs-target="#addtypeModal">[+]</a>
                    <div class="input-group">
                    <select class="form-select" id="selecttype" name="type_id">
                        <?php
                        include '../module/condb.php';
                        $sql4 = "SELECT * FROM type_durable_articles ORDER BY type_name";
                        $hand4 = mysqli_query($conn, $sql4);
                        while ($row4 = mysqli_fetch_array($hand4)) {

                        ?>
                        <option value="<?= $row4['type_id'] ?>">
                            <?= $row4['type_name'] ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                    <select class="form-select" id="selecttype" name="group_id">
                        <?php
                        include '../module/condb.php';
                        $sql4 = "SELECT * FROM group_type ORDER BY group_name";
                        $hand4 = mysqli_query($conn, $sql4);
                        while ($row4 = mysqli_fetch_array($hand4)) {

                        ?>
                        <option value="<?= $row4['group_id'] ?>">
                            <?= $row4['group_name'] ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <br>
                    <label style="margin-bottom:7px;">3. asset number</label>
                    <input type="text" name="asset" class="form-control" placeholder="asset number..."  pattern="[0-999999]"><br>
                    <label style="margin-bottom:7px;">4. asset number2</label>
                    <input type="text" name="asset2" class="form-control" placeholder="asset number..." ><br>
                    <label style="margin-bottom:7px;">5. status</label>
                    <input type="text" name="status" class="form-control" placeholder="status..." ><br>
                    <label style="margin-bottom:7px;">6. old articles number</label>
                    <input type="text" name="old_articles" class="form-control" placeholder="old articles number..."  ><br>
                    <label style="margin-bottom:7px;">7. Date received</label>
                    <input type="text" name="Date_received" class="form-control" placeholder="date received..."  ><br>
                    <label style="margin-bottom:7px;">8. Expenditure</label>
                    <input type="text" name="expenditure" class="form-control" placeholder="Expenditure..."  ><br>
                    </div>
                    <div class="col">
                    
                    <label style="margin-bottom:7px;">9. how get</label>
                    <input type="text" name="how_get" class="form-control" placeholder="how get..."  ><br>
                    <label style="margin-bottom:7px;">10. Amount of money</label>
                    <input type="text" name="money" class="form-control" placeholder="Amount of money..."  ><br>
                    <label style="margin-bottom:7px;">11. balance</label>
                    <input type="text" name="balance" class="form-control" placeholder="balance..."  ><br>
                    <label style="margin-bottom:7px;">12. organization</label>
                    <input type="text" name="organization" class="form-control" placeholder="organization..."  ><br>
                    <label style="margin-bottom:7px;">13. Note</label>
                    <input type="text" name="note" class="form-control" placeholder="Note..."  ><br>
                    
                    <label>14. Image</label>
                    <input type="file" name="filename" class="form-control" ><br>
                    
                    
                    
                    <button type="submit" class="btn btn-success mt-4">Save</button>
                    <a href="show_product.php" class="btn btn-primary mt-4" type="reset" value="Cancle">Back</a>
                    </div>
                </div>
                </div>
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