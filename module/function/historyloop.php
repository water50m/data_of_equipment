<?php



function historysearch($i){
include '../module/condb.php';
$sql = "SELECT * FROM history";

$resulte2 = mysqli_query($conn, $sql);
 while (($i > 0) and ($row =mysqli_fetch_array($resulte2))) {
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
$i=$i+1;

 }
}
        ?>