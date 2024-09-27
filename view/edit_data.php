<?php
include '../module/condb.php';
include '../module/function/play_db.php';
session_start();

$page = $_SESSION['page'];

if (isset($_SESSION['user_name'])) {




$idE = $_GET['id'];



$row = selectdbwhere('equipment_inspection_report','id',$idE,$pdo);
$type = selectdbwhere('type_durable_articles','type_id',$row['type_id'],$pdo)['type_name'];
$group = selectdbwhere('group_type','group_id',$row['group_id'],$pdo)['group_name'];
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
    <title>Edit data</title>
</head>
<body>
<?php include '../navbar/navbar.php'; ?>

    <div class="container ">
        <div class="row">
            <div class="col">
            <div class="alert h4 text-center alert-warning mt-4 md-4" role="alert">Edit data</div>

                <form name="form1" method="post" action="../module/data/update_equepment.php" enctype="multipart/form-data">
                <div class="container">
          <div class="row">
            <div class="col">
                  <input type="hidden" id="input1"  name="id" class="form-control" value="<?=$row['id']?>" required ><br>
                    <label style="margin-bottom:7px;">1. Item name</label>
                    <input type="text" id="input1"  name="name" class="form-control" value="<?=$row['Item']?>" required ><br>
                    <label style="margin-bottom:7px;">2. Type</label><a href="" data-bs-toggle="modal" data-bs-target="#addtypeModal">[+]</a>
                    
                    <div class="input-group">
                    <select class="form-select" name="select_type" aria-label="Default select example">
                    <option selected value="<?=$row['type_id']?>"><?=$type?></option>
                    <?php
                      $type_name = SelectAllData('type_durable_articles',$pdo);
                      foreach($type_name as $nameT){if($nameT['type_id'] == $row['type_id']){}else{

                      
                    ?>
                    <option value="<?=$nameT['type_id']?>"><?=$nameT['type_name']?></option>
               
                    <?php }} ?>
                    <!-- ........................................................................ -->
                    </select>
                    <select class="form-select" name="select_type" aria-label="Default select example" >
                    <option selected value="<?=$row['group_id']?>"><?=$group?></option>
                    <?php
                      $type_name = SelectAllData('group_type',$pdo);
                      foreach($type_name as $nameT){if($nameT['group_id'] == $row['group_id']){}else{

                      
                    ?>
                    <option value="<?=$nameT['group_id']?>"><?=$nameT['group_name']?></option>
               
                    <?php }} ?>
                    </select>
                    </div>


                    <label style="margin-bottom:7px;">3. asset number</label>
                    <input type="text" id="input1"  name="asset" class="form-control" value="<?=$row['asset_number'] ?>"  ><br>
                    <label style="margin-bottom:7px;">4. asset number2</label>
                    <input type="text" id="input1"  name="asset2" class="form-control" value="<?=$row['asset_number2'] ?>" ><br>
                    <label style="margin-bottom:7px;">5. status</label>
                    <input type="text" id="input1"  name="status" class="form-control" value="<?=$row['status'] ?>" ><br>
                    <label style="margin-bottom:7px;">6. old articles number</label>
                    <input type="text" id="input1"  name="old_articles" class="form-control" value="<?=$row['old_articles_number'] ?>"  ><br>
                    <label style="margin-bottom:7px;">7. Date received</label>
                    <input type="text"  id="input1" name="Date_received" class="form-control" value="<?=$row['date_received'] ?>"  ><br>
                    <label style="margin-bottom:7px;">8. Expenditure</label>
                    <input type="text"  id="input1" name="expenditure" class="form-control" value="<?=$row['expenditure'] ?>"  ><br>
                    </div>

                    <div class="col">
                    <label style="margin-bottom:7px;">9. how get</label>
                    <input type="text"  id="input1" name="how_get" class="form-control" value="<?=$row['how_get'] ?>"  ><br>
                    <label style="margin-bottom:7px;">10. Amount of money</label>
                    <input type="text" id="input1"  name="money" class="form-control" value="<?=$row['money'] ?>"  pattern ="[0-9]+" title="Please enter a valid number."><br>
                    <label style="margin-bottom:7px;">11. balance</label>
                    <input type="text" id="input1" name="balance" class="form-control" value="<?=$row['balance'] ?>"  pattern ="[0-9]+" title="Please enter a valid number."><br>
                    <label style="margin-bottom:7px;">12. organization</label>
                    <input type="text" id="input1" name="organization" class="form-control" value="<?=$row['agency'] ?>"  ><br>
                    <label style="margin-bottom:7px;">13. Location</label>
                    <input type="text" id="input1" name="location" class="form-control" value="<?=$row['location'] ?>"  ><br>
                    <label style="margin-bottom:7px;">14. Note</label>
                    <input type="text" id="input1" name="note" class="form-control" value="<?=$row['note'] ?>"  ><br>
                    
                    <label>15. Image</label>
                    <input type="file" name="filename" class="form-control" readonly><br>

                    <div class="bottom " >
                    <button type="submit" class="btn btn-success mt-4">Save</button>
                    <a href="Equepment.php" class="btn btn-primary mt-4" type="reset" value="Cancle">Back</a>
                    </div>
                </div>
              </div>
          </div>
                </form>      
                    
                

            </div>

        </div>


    </div>


<!-- ----------------------------------------------modal---------------------------------------------------------------------------------- -->

<!-- Modal -->


</body>
</html>
<?php
include 'modal.php';
}else{
  header('location: ui_login/Ui_login.php')  ;
}

?>