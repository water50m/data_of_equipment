<?php
include '../module/condb.php';
include '../module/function/play_db.php';
// include 'modal.php';
session_start();

if (isset($_SESSION['user_name'])) {

    date_default_timezone_set('Asia/Bangkok');
    $time = time();
    // $newTimestamp = strtotime('+7 hours', $time);
    $date = date("Y/m/d H:i:s", $time);
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <title>Show item</title>
    </head>

    <body>
        

        <div class="container col">
            

            <div class="row">
                <div class="col-6">
                    <?php

                    $status = $_SESSION['user_status'];
                    if ($status == 0 || $status == 1) {

                    ?>

                        
                    <?php
                    }
                    ?>
                </div>
                <div class="col-6">
                    
                </div>
            </div>
            <div class="row  mb-4">
                <div class="col">
                    <label style="margin-top:31px;">1. ชื่อผู้รับผิดชอบ</label>
                    <div class="input-group ">
                        <div class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                            </svg>
                        </div>
                        <input name="name_res" type="text" class="form-control" placeholder="Enter name..." aria-label="Example text with button addon" aria-describedby="button-addon1" value="พี่แพรว">
                    </div>
                    <label style="margin-top:15px;">3. วันที่</label>
                    <div class="input-group ">
                        <div class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                            </svg>
                        </div>
                        <input name="name_user" type="text" class="form-control" value="<?= $date ?>" aria-label="Example text with two button addons">

                    </div>
                </div>

                <div class="col">
                    <label style="margin-top:31px;">2. ชื่อผู้เบิก</label>
                    <div class="input-group ">

                        <div class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                            </svg>
                        </div>
                        <input name="name_user" type="text" class="form-control" placeholder="Enter name..." aria-label="Example text with two button addons">
                    </div>
                    <br>
                    <div class="row" >
                    <h5>                        (.......................................)</h5>
                                    <h7>ลงชื่อผู้เบิก</h7>
                                    </div>
                </div>
            </div>

            <table class="table table-hover ">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Material code</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Unit</th>
                    <th class="text-center">เบิก/เหลือ</th>
                    <th class="text-center">image</th>
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

                    $query = "SELECT * FROM withdraw AS p
                    WHERE CONCAT(p.material_code, p.name) LIKE '%$filtervalue%'";

                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $dataArray[] = $row;

                ?>
                                <tr>
                                    <td>
                                        <?= $row['id'] ?>
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
                                        <?= $row['expense'] ?>
                                    </td>
                                    <td class="text-center"><img src="../img/<?= $row['image'] ?>" width='80px' height='25%'></td>
                                    <?php
                                    $statud = $_SESSION['user_statud'];
                                    if ($statud == 0 or $statud == 1) {
                                    ?>
                                        <td class="text-center">
                                            <form action="..\module\withdraw_item\withdraw_item.php?id=<?= $row['id'] ?>" method="POST">
                                                <button name="id_remove" type="submit" class="btn btn-info mb-2">remove</button<br>

                                                    <button name="increase" type="submit" class="btn btn-info mb-2">+</button><br>

                                                    <button name="reduce" type="submit" class="btn btn-info mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-123" viewBox="0 0 16 16">
                                                            <path d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961h1.174Zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057h1.138Zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75v.96Z" />
                                                        </svg>-</button><br>
                                            </form>

                                        <?php
                                    }



                                        ?>

                                </tr>
                        <?php
                            }
                        }
                        // Serialize the array into a string
                        $serializedData = serialize($dataArray);

                        // Encode the serialized string for use in a URL
                        $encodedData = urlencode($serializedData);
                    } else {
                        echo "เกิดข้อผิดพลาดในการคิวรี: " . mysqli_error($conn);
                    }
                    //---------------------------------show item---------------------------------------------------------<-

                } else {
                    session_start();
                    $username = $_SESSION['user_name'];

                    $sql = "SELECT * FROM withdraw Where who_do = '$username'";
                    $hand = mysqli_query($conn, $sql);
                    


                    while ($row = mysqli_fetch_array($hand)) {
                        $current =  selectdbwhere('withdraw_item','current',$row['matherial_id'],$pdo);
                        $dataArray[] = $row;
                        ?>
                        <tr>
                            <td class="text-center"><?= $row['id'] ?></td>
                            <td><?= $row['material_code'] ?></td>

                            <td class="text-center"><?= $row['name'] ?></td>
                            <td class="text-center"><?= $row['unit'] ?></td>
                            <td class="text-center"><?= $row['expense'] ?>/<?= $current['current'] ?></td>
                            <td class="text-center"><img src="../img/<?= $row['image'] ?>" width='80px' height='25%'></td>
                            <?php
                            $statud = $_SESSION['user_statud'];
                            include 'modal.php';
                            ?>
                            <td class="text-center">
                                 <form action="..\module\withdraw_item\withdraw_item.php?id=<?= $row['id'] ?>" method="POST">

                                    
                
                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#volumModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-123" viewBox="0 0 16 16">
                                                <path d="M2.873 11.297V4.142H1.699L0 5.379v1.137l1.64-1.18h.06v5.961h1.174Zm3.213-5.09v-.063c0-.618.44-1.169 1.196-1.169.676 0 1.174.44 1.174 1.106 0 .624-.42 1.101-.807 1.526L4.99 10.553v.744h4.78v-.99H6.643v-.069L8.41 8.252c.65-.724 1.237-1.332 1.237-2.27C9.646 4.849 8.723 4 7.308 4c-1.573 0-2.36 1.064-2.36 2.15v.057h1.138Zm6.559 1.883h.786c.823 0 1.374.481 1.379 1.179.01.707-.55 1.216-1.421 1.21-.77-.005-1.326-.419-1.379-.953h-1.095c.042 1.053.938 1.918 2.464 1.918 1.478 0 2.642-.839 2.62-2.144-.02-1.143-.922-1.651-1.551-1.714v-.063c.535-.09 1.347-.66 1.326-1.678-.026-1.053-.933-1.855-2.359-1.845-1.5.005-2.317.88-2.348 1.898h1.116c.032-.498.498-.944 1.206-.944.703 0 1.206.435 1.206 1.07.005.64-.504 1.106-1.2 1.106h-.75v.96Z"></path>
                                            </svg>
                                            <span class="visually-hidden">Volum</span>
                                        </button>
                                        <button type="submit" name="id_remove" class="btn btn-outline-danger">
                                        <ion-icon name="trash-bin-outline" style="font-size: 16px;"></ion-icon>
                                            <span class="visually-hidden">Remove</span>
                                        </button>
                                        
                                    

                                </form>
                            </td>
                            <?php
                            if ($statud == 0 or $statud == 1) {
                            ?>
                                <script>
                                    document.querySelectorAll('.btn-warning').forEach(function(button) {
                                        button.addEventListener('click', function(event) {
                                            var material_code = '<?= $row['material_code'] ?>';
                                            fetch(`withdraw_item.php?material_code=${material_code}`, {
                                                method: 'POST'
                                            });
                                        });
                                    });
                                </script>

                            <?php
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

        <script language="JavaScript">
            function Del(mypage) {
                var agree = confirm("Do you want to delete this data?");
                if (agree) {
                    window.location = mypage;
                }
            }
        </script>
    </body>

    </html>

<?php

} else {
    header('location: ui_login/Ui_login.php');
}

include 'modal.php';
?>