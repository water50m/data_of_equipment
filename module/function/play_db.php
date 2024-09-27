<?php

function selectdbwhere($table_name,$col_name,$value,$pdo){
      
    $sql = $pdo->prepare("SELECT * FROM  $table_name WHERE $col_name=:place");
    $sql->bindParam(":place",$value,PDO::PARAM_STR);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result[0];

}

function SelectChain3Table($table,$J1_table,$J1_col,$j2_table,$j2_col,$pdo){

    $sql = $pdo->prepare("SELECT * FROM $table 
    JOIN $J1_table ON $table.$J1_col = $J1_table.$J1_col 
    JOIN $j2_table ON $table.$j2_col = $j2_table.$j2_col");  

    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}

function SelectAllData($table_name,$pdo){
    
    $sqlall = $pdo->prepare("SELECT * FROM  $table_name ");
    $sqlall->execute();
    $result = $sqlall->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}

// include '../condb.php';
// $data = selectdbwhere("group_type","group_id",1,$pdo);
// print_r($data['group_name']);

// include '../condb.php';
// $data = SelectAllData("equipment_inspection_report",$pdo);
// foreach($data as $row){
//     print_r($row);
//     echo"<br>";
//     echo"<br>";
// }

// include '../condb.php';
// $data = SelectChain3Table('equipment_inspection_report','group_type','group_id','type_durable_articles','type_id',$pdo);
// print_r($data);

?>