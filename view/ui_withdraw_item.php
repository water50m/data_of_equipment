<?php
include '../module/condb.php';
include '../module/function/play_db.php';
// include 'modal.php';
session_start();

if (isset($_SESSION['user_name'])) {
    // if (isset($_GET['data'])) {
    //     $encodedData = $_GET['data'];
    //     $decodedData = json_decode(base64_decode($encodedData), true);
    // }

    $sql = "SELECT COUNT(*) as count FROM withdraw_item"; 
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $num_alldata =  $row['count'];
    } else {
        echo "Error occurred.";
    }
    $page =1;

    if (isset($_GET['page'] )) {
        $page = $_GET['page'];
        
        
    }
    $start_from = 10*($page-1);


    $dataPerpage = 10;
    $last_page = $num_alldata%$dataPerpage;
    $num_page = ($num_alldata - $last_page)/$dataPerpage;
    

    if ($_GET['counter']) {
        $page = $_GET['counter'];
    }


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <title>Show item</title>
    </head>

    <body>
        <?php include '../navbar/navbar.php'; ?>

        <div class="container col">
            <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">Product data</div>

            <div class="row">
                <div class="col-3">
                    <?php

                    $status = $_SESSION['user_status'];
                    if ($status == 0 || $status == 1) {

                    ?>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addwidrow">Add+</button>
                        <a href="../module/function/saveToPdf.php?data=<?= $encodedData ?>" id="savepdf" class="btn btn-primary" role="button">Savepdf</a>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-6">
                    <div class="input-group" style="padding:0;">
                                
                                <?php 
                                
                                $i = 1;
                                while($i <= $num_page ){
                                ?>
                                <a class="btn btn-secondary" name ='page'href="ui_withdraw_item.php?page=<?=$i?>"><?=$i?></a>
                                

                                <?php
                                $i++;
                            }
                            ?>
                               
                </div>
                </div>
                <div class="col-3">
                    <form action="" method="GET" style="display: flex;">
                        <input type="search" name="search" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" value="<?php if (isset($_GET['search'])) {
                                                                                                                                            echo $_GET['search'];
                                                                                                                                        } ?>" class="form-control" placeholder="Search..." aria-label="Search">
                        <button type="submit" class="btn btn-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Search</button>
                    </form>
                </div>
            </div>
            

            <table class="table table-hover mx-auto">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Material code</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Unit</th>
                    <th class="text-center">Carry over</th>
                    <th class="text-center">Income</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Expense</th>
                    <th class="text-center">Remaining</th>
                    <th class="text-center">current()</th>
                    
                    <?php
                    $status = $_SESSION['user_status'];
                    if ($status == 0 || $status == 1) {
                    ?>
                        <th class="text-center">Edit</th>
                    <?php
                    }
                    ?>
                </tr>
                <?php
                if (isset($_GET['search'])) {
                    $filtervalue = $_GET['search'];

                    $query = "SELECT * FROM withdraw_item AS p
                    WHERE CONCAT(p.material_code, p.name) LIKE '%$filtervalue%'";
                    $count_search = 1;
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $dataArray[] = $row;
                ?>
                                <tr>
                                    <td>
                                        <?= $count_search ?>
                                    </td>
                                    <td>
                                        <?= $row['material_code'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['name'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['unit'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['carry_over'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['income'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['total'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['expense'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['remaining'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['current'] ?>
                                    </td>
                                    
                                    <?php
                                    $statud = $_SESSION['user_statud'];
                                    if ($statud == 0 or $statud == 1) {
                                    ?>
                                        <td class="text-center">
                                            <form action="..\module\withdraw_item\withdraw_item.php?id=<?=$row['id']?>" method="POST">
                                                <button  name="id_withdraw" type="submit" class="btn btn-info mb-2">withdraw</button<br>
                                                <a href=""class="btn btn-danger mb-2" name="Delete_material">Delete</a>
                                            </form>
                                                
                                            <a href="ui_edit_withdraw.php?id=<?= $row['id'] ?>"class="btn btn-warning mb-2" >Edit</a>
                                            
                                        </td>
                                <?php
                                    }
                                    $count_search+=1;
                            }
                        }
                        // Serialize the array into a string
                        $serializedData = serialize($dataArray);

                        // Encode the serialized string for use in a URL
                        $encodedData = urlencode($serializedData);
                    } else {
                        echo "เกิดข้อผิดพลาดในการคิวรี: " . mysqli_error($conn);
                    }
                } else {


                    $name = mysqli_real_escape_string($conn, $_POST['name']); // รับข้อมูลจากฟอร์มหรือที่มาอื่นๆ

                    // ตรวจสอบว่าข้อมูลที่ต้องการเพิ่มซ้ำหรือไม่
                    $check_query = "SELECT * FROM withdraw_item WHERE name = '$name'";
                    $check_result = mysqli_query($conn, $check_query);

                    if (mysqli_num_rows($check_result) > 0) {
                        // มีข้อมูลที่ซ้ำกันในฐานข้อมูล ไม่ให้เพิ่มข้อมูล
                    } else {
                        // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูลลงในฐานข้อมูล
                        // ตัวอย่างการเพิ่มข้อมูล:
                        $insert_query = "INSERT INTO withdraw_item (name) VALUES ('$name')";
                        if (mysqli_query($conn, $insert_query)) {
                            echo "เพิ่มข้อมูล $name เรียบร้อยแล้ว";
                        } else {
                            echo "ผิดพลาดในการเพิ่มข้อมูล: " . mysqli_error($conn);
                        }
                    }
                    
                    $sql = "SELECT * FROM withdraw_item LIMIT $start_from,$dataPerpage";
                    $hand = mysqli_query($conn, $sql);

                    



                        while ($row = mysqli_fetch_array($hand)) {
                            $dataArray[] = $row;
                                    ?>
                                    
                                    <tr>

                                        <td><?= $row['id'] ?></td>
                                        <td class="text-center"><?= $row['material_code'] ?></td>
                                        <td class="text-center"><?= $row['name'] ?></td>
                                        <td class="text-center"><?= $row['unit'] ?></td>
                                        <td class="text-center"><?= $row['carry_over'] ?></td>
                                        <td class="text-center"><?= $row['income'] ?></td>
                                        <td class="text-center"><?= $row['total'] ?></td>
                                        <td class="text-center"><?= $row['expense'] ?></td>
                                        <td class="text-center"><?= $row['remaining'] ?></td>
                                        <td class="text-center"><?= $row['current'] ?></td>
                                        
                                        <?php
                                        $statud = $_SESSION['user_statud'];
                                        if ($statud == 0 or $statud == 1) {
                                        ?>
                                        <td class="text-center">
                                            <form action="..\module\withdraw_item\withdraw_item.php?id=<?=$row['id']?>" method="POST">
                                                <button  name="id_withdraw" type="submit" class="btn btn-info mb-2">withdraw</button<br>
                                                <a href=""class="btn btn-danger mb-2" name="Delete_material">Delete</a>
                                            </form>
                                                
                                            <a href="ui_edit_withdraw.php?id=<?= $row['id'] ?>"class="btn btn-warning mb-2" >Edit</a>
                                            
                                        </td>
                                        


                                    <?php
                                        }
                                }
                                ?>
                                </tr>
                                
                            <?php


                            // Serialize the array into a string
                            $serializedData = serialize($dataArray);

                            // Encode the serialized string for use in a URL
                            $encodedData = urlencode($serializedData);
                        }
                        mysqli_close($conn);








                            ?>
            </table>
        </div>

        <script language="JavaScript">
            function Del(mypage) {
                var agree = confirm("Do you want to delete this data?");
                if (agree) {
                    window.location = mypage;
                }
            }

            // document.getElementById("savepdf").addEventListener("click", function () {
            //     // Handle saving PDF functionality
            // });
        </script>
    </body>

    </html>

<?php
include 'modal.php';
 }else {
    header('location: ui_login/Ui_login.php');
}


?>