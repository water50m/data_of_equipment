<?php
include '../module/condb.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>


<body>
  <div class="modal fade" id="addtypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Manage type</h1>
          <button type="button" class="btn-close  m-0" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col">
              <form action="../module/insert_newtype.php" method="POST">
                <label><h4>ประเภท</h4></label>
                <div class="input-group">
                  <input type="text" class="form-control" name="newtype" placeholder="New type name..." aria-label="Recipient's username with two button addons">

                  <button class="btn btn-outline-secondary" type="submit" style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;" name="new_type">Save</button>
                </div>
              </form>


              <form action="../module/delete_type.php" method="POST">
                <label>Edit/Delete </label><br>


                <div class="input-group mb-3">
                  <select class="form-select" id="selecttype" name="typeid">
                    <?php
                         
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
                  <button type="submit" class="btn btn-danger" name="delete_type">Delete</button>

                </div>
              </form>
              <form id="changeTypename" action="" method="POST">
                <div class="input-group mb-4">
                  <input type="text" id="newnametype" name="newnametype" class="form-control" placeholder="New name..." aria-label="Text input with dropdown button"><br>
                  <input type="hidden" id="hiddentype" name="selected" class="form-control"><br>
                  <button type="submit" id="btnEdit" class="btn btn-primary " name="change_type_name">Change name</button>
                </div>
              </form>
            </div>
            <div class="col">
            <form action="../module/insert_newtype.php" method="POST">
                <label><h4>ครุภัณฑ์</h4></label>
                <div class="input-group">
                  <input type="text" class="form-control" name="newtype" placeholder="New name..." aria-label="Recipient's username with two button addons">

                  <button class="btn btn-outline-secondary" type="submit" style="border-top-right-radius: 5px; border-bottom-right-radius: 5px;" name="new_group">Save</button>
                </div>
              </form>


              <form action="../module/delete_type.php" method="POST">
                <label>Edit/Delete</label><br>


                <div class="input-group mb-3">
                  <select class="form-select" id="selectgroup" name="groupid">
                    <?php

                    $sql4 = "SELECT * FROM group_type ORDER BY group_id";
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
                  <button type="submit" class="btn btn-danger" name="delete_group">Delete</button>

                </div>
              </form>
              <form id="changeTypename" action="" method="POST">
                <div class="input-group mb-4">
                  <input type="text" id="newnametype" name="newnametype" class="form-control" placeholder="New name..." aria-label="Text input with dropdown button"><br>
                  <input type="hidden" id="hiddentype" name="selected" class="form-control"><br>
                  <button type="submit" id="btnEdit" class="btn btn-primary " name="change_group_name">Change name</button>
                </div>
              </form>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>

          </div>



        </div>
      </div>
    </div>
  </div>
  <!------------------------------------------------------------------------------------modal 1------------------------------------------------------------------------------->
  <div class="modal fade" id="detailmodal<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

      <form action="" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">

                <div class="col">
                  <input type="hidden" id="input1" name="id" class="form-control" value="<?= $row['id'] ?>" required readonly><br>
                  <label style="margin-bottom:7px;">1. Item name</label>

                  <input type="text" id="input1" name="name" class="form-control" value="<?= $row['Item'] ?>" required readonly><br>

                  <?php
                  ?>
                  <label style="margin-bottom:21px;">2. Type</label>
                  <div class="input-group">
                    <input type="text" id="input1" name="type" class="form-control" value="<?= $row['type_name'] ?>" required readonly><br>
                    <input type="text" id="input1" name="type" class="form-control" value="<?= $row['group_name'] ?>" required readonly><br>
                  </div>

                  <label style="margin-bottom:7px;" class="mt-4">3. asset number</label>
                  <input type="text" id="input1" name="asset" class="form-control" value="<?= $row['asset_number'] ?>" pattern="[0-999999]" readonly><br>
                  <label style="margin-bottom:7px;">4. asset number2</label>
                  <input type="text" id="input1" name="asset2" class="form-control" value="<?= $row['asset_number2'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">5. status</label>
                  <input type="text" id="input1" name="status" class="form-control" value="<?= $row['status'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">6. old articles number</label>
                  <input type="text" id="input1" name="old_articles" class="form-control" value="<?= $row['old_articles_number'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">7. Date received</label>
                  <input type="text" id="input1" name="Date_received" class="form-control" value="<?= $row['date_received'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">8. Expenditure</label>
                  <input type="text" id="input1" name="expenditure" class="form-control" value="<?= $row['expenditure'] ?>" readonly><br>
                </div>
                <div class="col">
                  <label style="margin-bottom:7px;">9. how get</label>
                  <input type="text" id="input1" name="how_get" class="form-control" value="<?= $row['how_get'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">10. Amount of money</label>
                  <input type="text" id="input1" name="money" class="form-control" value="<?= $row['money'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">11. balance</label>
                  <input type="text" id="input1" name="balance" class="form-control" value="<?= $row['balance'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">12. organization</label>
                  <input type="text" id="input1" name="organization" class="form-control" value="<?= $row['agency'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">13. Location</label>
                  <input type="text" id="input1" name="location" class="form-control" value="<?= $row['location'] ?>" readonly><br>
                  <label style="margin-bottom:7px;">14. Note</label>
                  <input type="text" id="input1" name="note" class="form-control" value="<?= $row['note'] ?>" readonly><br>



                  <button type="button" class="btn btn-secondary  " data-bs-dismiss="modal">Close</button>

                </div>
                <?php
                session_start();

                if (($_SESSION['user_statud'] == 0) or ($_SESSION['user_statud'] == 1)) {    ?>

                  

                <?php } ?>
      </form>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>


  <!------------------------------------------------------------------------------------modal 2------------------------------------------------------------------------------->

  <div class="modal fade" id="addwidrow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <form action="../module/withdraw_item/withdraw_item.php" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col">
                  <input type="hidden" id="input1" name="id" class="form-control"  required><br>

                  <label style="margin-bottom:7px;">1. Material code</label>
                  <input type="text" id="input1" name="material_code" class="form-control"  ><br>

                  <label style="margin-bottom:7px;">2. Name</label>
                  <input type="text" id="input1" name="name" class="form-control"  required><br>
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
                  <label style="margin-bottom:7px;">4. Unit</label>
                  <input type="text" id="input1" name="unit" class="form-control"  ><br>
                  <label style="margin-bottom:7px;">5. Carry over</label>
                  <input type="text" id="input1" name="carry_over" class="form-control"  ><br>
                  </div>
                <div class="col ">
                  <label style="margin-bottom:7px;">6. Income</label>
                  <input type="text" id="input1" name="income" class="form-control"  ><br>
                  <label style="margin-bottom:7px;">7. Expense</label>
                  <input type="text" id="input1" name="expense" class="form-control"  ><br>
                  <label style="margin-bottom:7px;">8. Remaining</label>
                  <input type="text" id="input1" name="remaining" class="form-control"  ><br>
                
                  <label style="margin-top:31px;">9. Current</label>
                  <input type="text" id="input1" name="current" class="form-control" ><br>

                  

                  
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
          <a href="ui_withdraw_item.php" class="btn btn-primary mt-4" type="reset" value="Cancle" style="width: 150px;">Back</a>
        <button type="submit" name="add_product" class="btn btn-success mt-4" style="width: 150px;">Save</button>

                  
          </div>

        </div>
      </form>
    </div>
  </div>
  <!------------------------------------------------------------------------------------modal 3 volum------------------------------------------------------------------------------->
  
  <form action="..\module\withdraw_item\withdraw_item.php" method="POST">
  <div class="modal fade" id="volumModal" tabindex="-1" aria-labelledby="volumModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Quantity</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          
        </div>
        <div class="modal-body">
        <div class="input-group ">
          <div class="input-group-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-123" viewBox="0 0 16 16">
              <path d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961h1.174Zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057h1.138Zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75v.96Z" />
            </svg>
          </div>
          <input name="quantity" type="number" class="form-control" placeholder="quantity..." aria-label="Recipient's username with two button addons">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="Order">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  </form>

  <!------------------------------------------------------------------------------------modal 3 volum------------------------------------------------------------------------------->

</body>

</html>
<script>
  document.getElementById("btnEdit").addEventListener("click", function() {
    var selecttype = document.getElementById("selecttype").value;
    var hiddenInput = document.getElementById("hiddentype");
    hiddenInput.value = selecttype;

    var nntype = document.getElementById("newnametype");

    var form = document.getElementById("changeTypename");

    form.action = "../module/edit_type.php";
    form.submit();


  });
</script>