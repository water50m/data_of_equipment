<?php
include ("../module/condb.php");
include ("../module/withdraw_item/withdraw_item.php");
include ("../module/function/play_db.php");
$id = $_GET['id'];
$data = new stock($conn);
$alldata = $data->searchById('withdraw_item',$id);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
       
    <title>Edit data</title>
</head>
<body>
<?php include '../navbar/navbar.php'; ?>
<div class="container">
          <div class="row">
          <div class="alert h4 text-center alert-warning mt-4 md-4" role="alert">Edit data</div>
            <div class="col">
                    <input type="hidden" id="input1"  name="id" class="form-control" value="<?=$alldata['id']?>" required ><br>

                    <label style="margin-bottom:7px;">1. Material code</label>
                    <input type="text" id="input1"  name="material_code" class="form-control" value="<?=$alldata['material_code']?>" required ><br>

                    <label style="margin-bottom:7px;">2. Name</label>
                    <input type="text" id="input1"  name="name" class="form-control" value="<?=$alldata['name'] ?>" required><br>
                    <label style="margin-bottom:7px;">3. Type</label>
                    <div class="input-group mb-3">
                    <select class="form-select" id="selectgroup" name="typeid">
                        <?php
                        $material_thpe = SelectAllData('type_material',$pdo);
                        
                        foreach($material_thpe as $row4){
                        ?>
                        <option value="<?= $row4['type_id'] ?>">
                            <?= $row4['type_name'] ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>

                    </div>
                    <label style="margin-bottom:7px;">3. Unit</label>
                    <input type="text" id="input1"  name="unit" class="form-control" value="<?=$alldata['unit'] ?>" required><br>
                    <label style="margin-bottom:7px;">4. Carry over</label>
                    <input type="text" id="input1"  name="carry_over" class="form-control" value="<?=$alldata['carry_over'] ?>" required><br>
                    <label style="margin-bottom:7px;">5. Income</label>
                    <input type="text" id="input1"  name="income" class="form-control" value="<?=$alldata['income'] ?>"  required><br>
                    </div>
                    <div class="col ">
                    <label style="margin-bottom:7px;">6. Expense</label>
                    <input type="text"  id="input1" name="expense" class="form-control" value="<?=$alldata['expense'] ?>"  required><br>
                    <label style="margin-bottom:7px;">7. Remaining</label>
                    <input type="text"  id="input1" name="remaining" class="form-control" value="<?=$alldata['remaining'] ?>"  required><br>
                    
                    <label style="margin-top:31px;">8. Current</label>
                    <input type="text"  id="input1" name="current" class="form-control" value="<?=$alldata['current'] ?>" required ><br>
                    
                    
                    <a href="ui_withdraw_item.php" class="btn btn-primary mt-4" type="reset" value="Cancle">Back</a>
                    <button type="submit" name ="add_product" class="btn btn-success mt-4" href="ui_withdraw_item.php">Save</button>
                    
                </div>
              </div>
          </div>
</body>
</html>