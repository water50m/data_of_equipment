<?php

include '../module/function/Date.php';
include '../navbar/navbar.php';
session_start();
if (isset($_SESSION['user_name'])) {
    include '../module/condb.php';
    $sql = "SELECT * FROM history";
    $resulte = mysqli_query($conn, $sql);
    $resulte2 = mysqli_query($conn, $sql);

    while ($rows = mysqli_fetch_array($resulte)) {
        $date = $rows['Date_T'];


        $year = DateTo($date);
        $allyear = array();

        array_push($allyear, $year['y']);

    }
    $max = max($allyear);
    $min = min($allyear);

    $start = $min - 5;
    $stop = $max + 5;
    $start2 = $min - 5;
    $stop2 = $max + 5;
    $i = 15;
    if ($_GET['counter']) {
        $i = $_GET['counter'];
    }




    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>History</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container col-sm-8 mt-0">
            <div class="alert h4 text-center alert-primary mt-4 md-4" role="alert">History</div>
            <div class="row">
                <div class="container col-sm-2 mt-0">
                    <form action="" method="GET" style="display: flex;">
                        <button type="submit" class="btn btn-primary"
                            style="border-top-right-radius: 0; border-bottom-right-radius: 0;">Show</button>
                        <input type="number" name="counter" style="border-top-left-radius: 0; border-bottom-left-radius: 0;"
                            value="<?= $i ?>" class="form-control" aria-label="Search">
                    </form>
                </div>


                <div class="container col-sm-10 mt-0">
                    <div class="row">
                        <form action="" method="GET">
                            <div class="input-group">
                                <select class="form-select " name="fYYYY" aria-label="Default select example">
                                    <option selected>YYYY</option>
                                    <!-- Example split danger button -->
                                    <?php




                                    while ($start <= $stop) {
                                        ?>


                                        <option value="<?= $start ?>">
                                            <?= $start ?>
                                        </option>


                                        <?php
                                        $start = $start + 1;
                                    }
                                    ?>


                                </select>
                                <select class="form-select" name="fMM" aria-label="Default select example">
                                    <option selected>MM</option>
                                    <option value="01">January</option>
                                    <option value="02">Febuary</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>


                                </select>
                                <select class="form-select" name="fDD" aria-label="Default select example">
                                    <option selected>DD</option>

                                    <?php
                                    $j = 1;
                                    while ($j <= 31) {
                                        if ($j < 10) {
                                            $j = '0' . $j;
                                        }
                                        ?>

                                        <option value="<?= $j ?>">
                                            <?= $j ?>
                                        </option>

                                        <?php
                                        $j++;
                                    }


                                    ?>

                                </select>
                                <button type="submit" class="btn btn-secondary">to</button>
                                <select class="form-select " name="YYYY" aria-label="Default select example">
                                    <option selected>YYYY</option>
                                    <!-- Example split danger button -->
                                    <?php




                                    while ($start2 <= $stop2) {
                                        ?>


                                        <option value="<?= $start2 ?>">
                                            <?= $start2 ?>
                                        </option>


                                        <?php
                                        $start2 = $start2 + 1;
                                    }
                                    ?>


                                </select>
                                <select class="form-select" name="MM" aria-label="Default select example">
                                    <option selected>MM</option>
                                    <option value="01">January</option>
                                    <option value="02">Febuary</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>


                                </select>
                                <select class="form-select" name="DD" aria-label="Default select example">
                                    <option selected>DD</option>

                                    <?php
                                    $j = 1;
                                    while ($j <= 31) {
                                        if ($j < 10) {
                                            $j = '0' . $j;
                                        }
                                        ?>

                                        <option value="<?= $j ?>">
                                            <?= $j ?>
                                        </option>

                                        <?php
                                        $j++;
                                    }


                                    ?>

                                </select>
                                <button type="submit" class="btn btn-danger">Go</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php







            if ($_GET['YYYY'] and $_GET['MM'] and $_GET['DD']) {
                $yyyy = $_GET['YYYY'];
                $mm = $_GET['MM'];
                $dd = $_GET['DD'];
                $fyyyy = $_GET['fYYYY'];
                $fmm = $_GET['fMM'];
                $fdd = $_GET['fDD'];

                // Check if the values are placeholders and set them to null if true
                if ($yyyy === 'YYYY') {
                    $yyyy = null;
                    
                }
                if ($mm === 'MM') {
                    $mm = null;
                    
                }
                if ($dd === 'DD') {
                    $dd = null;
                    
                }
                if ($fyyyy === 'YYYY') {
                    $fyyyy = null;
                    
                }
                if ($fmm === 'MM') {
                    $fmm = null;
                    
                }
                if ($fdd === 'DD') {
                    $fdd = null;
                    
                }
                
                if (($yyyy !== null or $mm !== null or $dd !== null) and ($fyyyy !== null or $fmm !== null or $fdd !== null)) {
                   
                    $query = "SELECT * FROM history WHERE Date_T BETWEEN " .
                        "'" . ($fyyyy !== null ? "$fyyyy%" : "%") .
                        "-" . ($fmm !== null ? "$fmm%" : "%") .
                        "-" . ($fdd !== null ? "$fdd%" : "%") . "'" .
                        " AND " .
                        "'" . ($yyyy !== null ? "$yyyy%" : "%") .
                        "-" . ($mm !== null ? "$mm%" : "%") .
                        "-" . ($dd !== null ? "$dd%" : "%") . "'" .
                        " ORDER BY Date_T DESC";


                    

                    $data = mysqli_query($conn, $query);
                    // $numRows = mysqli_num_rows($data);
                    // echo "Number of rows: $numRows";
                    while (($i > 0) and ($row = mysqli_fetch_array($data))) {

                        if (!empty($row['Date_T'])) {
                            echo $row['Date_T'] . '<br>';
                        }
                        if (!empty($row['user_id'])) {
                            echo 'Make by ' . $row['user_id'] . '<br>';
                        }
                        if (!empty($row['what_do'])) {
                            echo $row['what_do'] . '<br>';
                        }
                        if (!empty($row['what_was'])) {
                            echo $row['what_was'] . '<br>';
                        }
                        if (!empty($row['note_hs'])) {
                            echo $row['note_hs'] . '<br>';
                        }
                        echo '==========================================================================================<br>';
                        $i = $i - 1;
                    }

                }
                // Create a formatted date string
                else if (($yyyy === null and $mm === null and $dd === null) or ($fyyyy === null and $fmm === null and $fdd === null)) {
                    if ($fyyyy === null and $fmm === null and $fdd === null) {
                        
                        $query = "SELECT * FROM history WHERE Date_T LIKE " .
                            "'" . ($yyyy !== null ? "$yyyy%" : "%") .
                            "-" . ($mm !== null ? "$mm%" : "%") .
                            "-" . ($dd !== null ? "$dd%" : "%") . "'" .
                            " ORDER BY Date_T DESC";

                    }
                    else if ($yyyy === null and $mm === null and $dd === null) {
                        
                        $query = "SELECT * FROM history WHERE Date_T LIKE " .
                            "'" . ($fyyyy !== null ? "$fyyyy%" : "%") .
                            "-" . ($fmm !== null ? "$fmm%" : "%") .
                            "-" . ($fdd !== null ? "$fdd%" : "%") . "'" .
                            " ORDER BY Date_T DESC";

                    }
                    
                    $data = mysqli_query($conn, $query);

                    while (($i > 0) and ($row = mysqli_fetch_array($data))) {

                        if (!empty($row['Date_T'])) {
                            echo $row['Date_T'] . '<br>';
                        }
                        if (!empty($row['user_id'])) {
                            echo 'Make by ' . $row['user_id'] . '<br>';
                        }
                        if (!empty($row['what_do'])) {
                            echo $row['what_do'] . '<br>';
                        }
                        if (!empty($row['what_was'])) {
                            echo $row['what_was'] . '<br>';
                        }
                        if (!empty($row['note_hs'])) {
                            echo $row['note_hs'] . '<br>';
                        }
                        echo '==========================================================================================<br>';
                        $i = $i - 1;
                    }    




                }
            } else {
                $sql1 = "SELECT * FROM history  ORDER BY id DESC";
                $data = mysqli_query($conn, $sql1);

                while (($i > 0) and ($row = mysqli_fetch_array($data))) {

                    if (!empty($row['Date_T'])) {
                        echo $row['Date_T'] . '<br>';
                    }
                    if (!empty($row['user_id'])) {
                        echo 'Make by ' . $row['user_id'] . '<br>';
                    }
                    if (!empty($row['what_do'])) {
                        echo $row['what_do'] . '<br>';
                    }
                    if (!empty($row['what_was'])) {
                        echo $row['what_was'] . '<br>';
                    }
                    if (!empty($row['note_hs'])) {
                        echo $row['note_hs'] . '<br>';
                    }
                    echo '==========================================================================================<br>';
                    $i = $i - 1;

                }
            }
            ?>
        </div>

    </body>

    </html>
    <?php

} else {
    header('location: ui_login/Ui_login.php');
}
?>