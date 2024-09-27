<?php
include '../module/condb.php';
session_start();

if (isset($_SESSION['user_name'])) {
    if (isset($_GET['data'])) {
        $encodedData = $_GET['data'];
        $decodedData = json_decode(base64_decode($encodedData), true);
        
        // ต่อไปจะใช้ $decodedData ตามที่คุณต้องการ
        // ...
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="newwork2/bootstrap/css/bootstrap.rtl.min.css" > -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Show item</title>
    </head>

    <body>
        <?php include '../navbar/navbar.php'; ?>

        <div class="container col-sm-8 ">
            <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">Product data</div>

            <div class="row">
                <div class="col-6">
                    <?php
                    $statud = $_SESSION['user_statud'];
                    if ($statud == 0 or $statud == 1) {
                        ?>
                        <a href="fr_product.php" class="btn btn-primary" role="button">Add+</a>
                        <a href="../module/function/saveToPdf.php?data=<?=$encodedData?>" id="savepdf" class="btn btn-primary" role="button">Savepdf</a>

                        <?php
                    } else {
                    }
                    ?>
                
                </div>
                <div class="col-6">
                    <form action="" method="GET" style="display: flex;">
                        <input type="search" name="search"
                            style="border-top-right-radius: 0; border-bottom-right-radius: 0;"
                            value="<?php if (isset($_GET['search'])) {
                                echo $_GET['search'];
                            } ?>" class="form-control"
                            placeholder="Search..." aria-label="Search">
                        <button type="submit" class="btn btn-primary"
                            style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Search</button>
                    </form>
                </div>
            </div>
            <
            <table class="table table-hover mx-auto ">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Type</th>
                    <th>Price(฿)</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">location</th>
                    <th class="text-center">Note</th>
                    <?php
                    $statud = $_SESSION['user_statud'];
                    if ($statud == 0 or $statud == 1) {
                        ?>
                        <th class="text-center">Edit</th>
                        <?php
                    } else {
                    }
                    ?>


                </tr>
                <?php

                if (isset($_GET['search'])) {
                    $filtervalue = $_GET['search'];

                    $query = "SELECT * FROM product AS p
                        JOIN type1 AS t1 ON p.type_id = t1.type_id
                        WHERE CONCAT(p.pro_id, p.pro_name, t1.type_name) LIKE '%$filtervalue%'";

                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $dataArray[] = $row;
                                
                                // ทำสิ่งที่คุณต้องการกับข้อมูลที่ดึงมา
            
                                ?>
                                <tr>
                                    <td>
                                        <?= $row['pro_id'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['pro_name'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['type_name'] ?>
                                    </td>
                                    <td>
                                        <?= $row['price'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['amount'] ?>
                                    </td>
                                    <td class="text-center"><img src="../img/<?= $row['image'] ?>" width='80px' height='25%'></td>
                                    <td class="text-center">
                                        <?= $row['location'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['Note'] ?>
                                    </td>
                                    <?php
                                    $statud = $_SESSION['user_statud'];
                                    if ($statud == 0 or $statud == 1) {
                                        ?>
                                        <td class="text-center"><a href="edit_product.php?id=<?= $row['pro_id'] ?>"
                                                class="btn btn-warning mb-2">Edit</a><br><a
                                                href="../module/delete_pro.php?id=<?= $row['pro_id'] ?>" onclick="Del(this.href);return false;"
                                                class="btn btn-danger ">Delete</a></td>

                                        <?php
                                    
                                    } else {
                                    }
                                    ?>

                                </tr>
                                <?php
                            }
                        } else {

                        }
                        // Serialize the array into a string
                    $serializedData = serialize($dataArray);

                    // Encode the serialized string for use in a URL
                    $encodedData = urlencode($serializedData);
                    } else {
                        echo "เกิดข้อผิดพลาดในการคิวรี: " . mysqli_error($conn);
                    }
                } else {


                    $sql = "SELECT * FROM product,type1 WHERE product.type_id = type1.type_id";
                    $hand = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($hand)) {
                        $dataArray[] = $row;
                        
                        ?>
                        <tr>

                            <td>
                                <?= $row['pro_id'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['pro_name'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['type_name'] ?>
                            </td>
                            <td>
                                <?= $row['price'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['amount'] ?>
                            </td>
                            <td class="text-center"><img src="../img/<?= $row['image'] ?>" width='80px' height='25%'></td>
                            <td class="text-center">
                                <?= $row['location'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['Note'] ?>
                            </td>
                            <?php
                            $statud = $_SESSION['user_statud'];
                            if ($statud == 0 or $statud == 1) {
                                ?>
                                <td class="text-center"><a href="edit_product.php?id=<?= $row['pro_id'] ?>"
                                        class="btn btn-warning mb-2">Edit</a><br><a
                                        href="../module/delete_pro.php?id=<?= $row['pro_id'] ?>" onclick="Del(this.href);return false;"
                                        class="btn btn-danger ">Delete</a></td>

                                <?php
                            } else {
                            }
                            ?>

                        </tr>
                        <?php
                    }
                    
                    // Serialize the array into a string
                    $serializedData = serialize($dataArray);

                    // Encode the serialized string for use in a URL
                    $encodedData = urlencode($serializedData);
                }
                mysqli_close($conn);


                ?>
            </table>
                  

        </div>
    </body>

    </html>

    <script language="JavaScript">
        function Del(mypage) {
            var agree = confirm("Do you want to delete this data?");
            if (agree) {
                window.location = mypage;
            }
        }


        
  document.getElementById("savepdf").addEventListener("click", function () {
    var selecttype = document.getElementById("selecttype").value;
    var hiddenInput = document.getElementById("hiddentype");
    hiddenInput.value = selecttype;

    var nntype = document.getElementById("newnametype");

    var form = document.getElementById("changeTypename");

    form.action = "../module/edit_type.php";
    form.submit();


  });




    </script>

    <?php
} else {
    header('location: ui_login/Ui_login.php');
}
?>