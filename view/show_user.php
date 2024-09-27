<?php
include '../module/condb.php';
session_start();

if ($_SESSION['user_name'] and ($_SESSION['user_statud'] == 0)) {


    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="newwork2/bootstrap/css/bootstrap.rtl.min.css" > -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>User</title>
    </head>

    <body>
        <?php include '../navbar/navbar.php'; ?>

        <div class="container col-sm-8 ">
            <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">User</div>

            <div class="row">
                <div class="col-6">
                    

                </div>
                <div class="col-6">
                    
                </div>
            </div>

            <table class="table table-hover mx-auto ">
                <tr>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Tel.</th>
                    <th class="text-center">Status</th>
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

                } else {


                    $sql = "SELECT * FROM users";
                    $hand = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($hand)) {

                        ?>
                        

                        <tr>
                            <td>
                                <?= $row['username'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['email'] ?>
                            </td>
                            <td class="text-center">
                                <?= $row['phone'] ?>
                            </td>
                            
                            <?php
                            if ($row['statud'] == 0) {
                                ?>
                                <td class="text-center">Admin</td>
                                <?php
                            }
                            if ($row['statud'] == 1) {
                                ?>
                                <td class="text-center">High level user</td>
                                <?php
                            }
                            if ($row['statud'] == 2) {
                                ?>
                                <td class="text-center">User</td>
                                <?php
                            }
                            ?>
                            <?php
                            $statud = $_SESSION['user_statud'];
                            if ($statud == 0 or $statud == 1) {
                                ?>
                                <td class="text-center"><a href="edit_user.php?id=<?= $row['id'] ?>"
                                        class="btn btn-warning mb-2">Edit</a><br><a
                                        href="../module/delete_user.php?id=<?= $row['id'] ?>" onclick="Del(this.href);return false;"
                                        class="btn btn-danger ">Delete</a></td>

                                <?php
                            } else {
                            }
                            ?>

                        </tr>
                        <?php
                    }
                }
                mysqli_close($conn);
                ?>




            </table>
        </div>

    </body>

    </html>

    <script language="JavaScript">
        function Del(mypage) {
            var agree = confirm("Do you want to delete this user?");
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