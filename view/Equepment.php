<?php
include '../module/condb.php';
include '../module/function/play_db.php';
// include 'modal.php';
session_start();

if (isset($_SESSION['user_name'])) {
    // if (isset($_GET['data'])) {
    //     $encodedData = $_GET['data'];
    //     $decodedData = json_decode(base64_decode($encodedData), true);

    //     // ต่อไปจะใช้ $decodedData ตามที่คุณต้องการ
    //     // ...
    // }
    $count = 4;
    if ($_GET['counter']) {
        $count = $_GET['counter'];
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="newwork2/bootstrap/css/bootstrap.rtl.min.css" > -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <title>Show item</title>
    </head>

    <body>
        <?php include '../navbar/navbar.php'; ?>
        <div class="container ">
            <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">Product data</div>

            <div class="row">
                <div class="col-1">

                    <?php
                    $statud = $_SESSION['user_statud'];
                    if ($statud == 0 or $statud == 1) {
                    ?>



                        <a href="add_data.php" class="btn btn-primary " role="button">Add+</a>
                    <?php
                    } else {
                    }
                    ?>

                </div>
                <div class="col-2">


                    <form action="" method="GET" style="display: flex;">
                        <button type="submit" class="btn btn-primary" style="border-top-right-radius: 0; border-bottom-right-radius: 0;">Show</button>
                        <input type="number" name="counter" style="border-top-left-radius: 0; border-bottom-left-radius: 0; " value="<?= $count ?>" class="form-control" aria-label="Search">
                    </form>
                </div>
                <div class="col-5">
                </div>
                <div class="col-4">


                    <form action="" method="GET" style="display: flex;">
                        <input type="search" name="search" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" value="<?php if (isset($_GET['search'])) {
                                                                                                                                            echo $_GET['search'];
                                                                                                                                        } ?>" class="form-control" placeholder="Search..." aria-label="Search">


                        <button type="submit" class="btn btn-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">Search</button>
                    </form>
                </div>
            </div>
            <table class="table table-hover mx-auto ">
                <tr>
                    <th class="text-center">Number</th>
                    <th class="text-center">Item,size,nature</th>
                    <th class="text-center">asset_number</th>
                    <th class="text-center">status</th>
                    <th class="text-center">organization</th>
                    <th class="text-center">location</th>
                    <th class="text-center">Image</th>

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


                    $query = "SELECT * FROM equipment_inspection_report 
                        WHERE CONCAT(Item,asset_number, asset_number2,agency,location,date_received) LIKE '%$filtervalue%'";
                    $j = 1;
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $dataArray[] = $row;
                                include 'modal.php';
                ?>

                                <tr>

                                    <td class="text-center">
                                        <?php
                                        echo $j . '.';

                                        ?>

                                    <td>
                                        <?= $row['Item'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['asset_number'] ?>
                                    </td>
                                    <td>
                                        <?= $row['status'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['agency'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $row['location'] ?>
                                    </td>
                                    <td class="text-center"><img src="../img/<?= $row['img'] ?>" width='80px' height='25%'></td>
                                    <td class="text-center">
                                        <a style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#detailmodal<?= $row['id'] ?>" class="btn btn-info mb-2" id="detail">Detail</a><br>
                                        <?php
                                        $statud = $_SESSION['user_statud'];
                                        if ($statud == 0 or $statud == 1) {
                                        ?>

                                            <a class="btn btn-warning mb-2" href="edit_data.php?id=<?= $row['id'] ?>" type="submit">Edit</a><br><a href="../module/data/delete_equepment.php?id=<?= $row['id'] ?>" onclick="Del(this.href);return false;" class="btn btn-danger ">Delete</a>


                                        <?php
                                        } else {
                                        }
                                        ?>
                                    </td>
                                </tr>
                        <?php
                                $j++;
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


                    // $sql = "SELECT * FROM equipment_inspection_report ";
                    // $hand = mysqli_query($conn, $sql);
                    $i = 1;
                    $data =  SelectChain3Table('equipment_inspection_report', 'group_type', 'group_id', 'type_durable_articles', 'type_id', $pdo);

                    // while (($count > 0) and ($row = mysqli_fetch_array($hand))) {

                    foreach ($data as $row) {

                        $dataArray[] = $row;
                        include 'modal.php';;

                        ?>


                        <tr>

                            <td class="text-center">
                                <?php
                                echo $i . '.';
                                ?>
                            <td>
                                <?= nl2br($row['Item']) ?>
                            </td>
                            <td class="text-center">
                                <?= $row['asset_number'] ?>
                            </td>
                            <td>
                                <?= $row['status'] ?>
                            </td>

                            <td class="text-center">
                                <?= nl2br($row['agency']) ?>
                            </td>
                            <td class="text-center">

                                <?= $row['location'] ?>
                            </td>

                            <td class="text-center"><img src="../img/<?= $row['img'] ?>" width='80px' height='25%'></td>
                            <td class="text-center">
                                <a style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#detailmodal<?= $row['id'] ?>" class="btn btn-info mb-2" id="detail"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg></a><br>
                                <?php

                                $statud = $_SESSION['user_statud'];
                                if ($statud == 0 or $statud == 1) {
                                ?>
                                    <a class="btn btn-outline-primary mb-2" href="clone_data.php?id=<?= $row['id'] ?>" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V2Zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6ZM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1H2Z" />
                                        </svg></a><br>

                                    <a class="btn btn-warning mb-2" href="edit_data.php?id=<?= $row['id'] ?>" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                        </svg></a><br>

                                    <a href="../module/data/delete_equepment.php?id=<?= $row['id'] ?>" onclick="Del(this.href);return false;" class="btn btn-danger mb-2">Delete</a><br>


                                <?php
                                    $count = $count - 1;
                                } else {
                                }
                                ?>
                            </td>
                        </tr>
                <?php
                        $i++;
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
        <a href="../module/function/saveToPdf_1.php?data=<?= $encodedData ?>" id="savepdf" class="btn btn-primary mb-2" role="button" target="_blank">Savepdf</a>

    </body>

    </html>

    <script language="JavaScript">
        function Del(mypage) {
            var agree = confirm("Do you want to delete this data?");
            if (agree) {
                window.location = mypage;
            }
        }

    </script>

<?php
} else {
    header('location: ui_login/Ui_login.php');
}
?>