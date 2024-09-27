<?php


include '../condb.php';


// include 'connectPTtable.php';

$id  =$_POST['id'];
$name = $_POST['name'];
$asset = $_POST['asset'];
$asset2 = $_POST['asset2'];
$status = $_POST['status'];
$old_articles = $_POST['old_articles'];
$Date_received = $_POST['Date_received'];
$expenditure = $_POST['expenditure'];
$how_get = $_POST['how_get'];
$money = $_POST['money'];
$balance = $_POST['balance'];
$organization = $_POST['organization'];
$location = $_POST['location'];
$note = $_POST['note'];

// echo 'id is:'.$id;
$stmt = $pdo->prepare("SELECT * FROM equipment_inspection_report WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$longtext = ['Edit list'];

if($result){
    if($result['Item'] != $name){
        $str = $result['Item'];
        $text1 = $str." ----> $name";
        array_push($longtext, $text1);
    }
    if($result['asset_number'] != $asset){
        $text2 = $result['asset_number']." ----> $asset";
        array_push($longtext, $tex2);
    }
    if($result['asset_number2'] != $asset2){
        $text3 = $result['asset_number2']." ----> $asset2";
        array_push($longtext, $text3);
    }
    if($result['status'] != $status){
        $text4 = $result['status']." ----> $status";
 
        array_push($longtext, $text4);
    }
    if($result['old_articles_number'] != $old_articles){
        $text5 = $result['old_articles_number']." ----> $old_articles";
        array_push($longtext, $text5);
    }
    if($result['date_received'] != $Date_received){
        $text6 = $result['date_received']." ----> $Date_received";
        array_push($longtext, $text6);
    }
    if($result['expenditure'] != $expenditure){
        $text7 = $result['expenditure']." ----> $expenditure";
        array_push($longtext, $text7);
    }
    if($result['how_get'] != $how_get){
        $text8 = $result['how_get']." ----> $how_get";
        array_push($longtext, $text8);
    }
    if($result['money'] != $money){
        $text9 = $result['money']." ----> $money";
        array_push($longtext, $text9);
    }
    if($result['balance'] != $balance){
        $text10 = $result['balance']." ----> $balance";
        array_push($longtext, $text10);
    }
    if($result['agency'] != $organization){
        $text11 = $result['agency']." ----> $organization";
        array_push($longtext, $text11);
    }
    if($result['location'] != $location){
        $text12 = $result['location']." ----> $location";
        array_push($longtext, $text12);
    }
    if($result['note'] != $note){
        $text13 = $result['note']." ----> $note";
        array_push($longtext, $text13);
    }
}


$StrText = implode('<br>- ', $longtext);

session_start();

$user = $_SESSION['user_name'];
include '../save_history.php';

saveToHistory("Edit data item",$name ,$user ,$StrText );

if (isset($_FILES['filename']['tmp_name']) && is_uploaded_file($_FILES['filename']['tmp_name'])) {
    $temp_image_path = $_FILES['filename']['tmp_name'];
    
    // สร้างชื่อไฟล์ใหม่
    $new_image_name = 'pr_' . uniqid() . '.' . pathinfo(basename($_FILES['filename']['name']), PATHINFO_EXTENSION);
    
    // ตำแหน่งที่คุณต้องการจะบันทึกไฟล์
    $image_upload_path = "../../img/" . $new_image_name;
    
    // ย้ายไฟล์ไปยังตำแหน่งที่คุณต้องการ
    if(!empty($new_image_name)){
   
    $data ="UPDATE equipment_inspection_report SET img='$new_image_name' WHERE id = '$id'";
    $hand = mysqli_query($conn,$data);

    }
}


$sql = "UPDATE equipment_inspection_report SET Item = '$name', asset_number = '$asset' , asset_number2 = '$asset2', status = '$status'
, old_articles_number = '$old_articles', date_received = '$Date_received', expenditure = '$expenditure', how_get = '$how_get', money = '$money'
, balance = '$balance', agency = '$organization', note = '$note',  location = '$location' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);



if($result){
    
   
    

    move_uploaded_file($temp_image_path, $image_upload_path);  
    echo "<script>alert('Save data success!');</script>";
    echo "<script>window.location='../../view/Equepment.php'; </script>";
    
}else{

    echo "<script>alert('Save data failed!');</script>";
    echo "<script>window.location='../../view/Equepment.php'; </script>";
    

    die("SQL query failed: " . mysqli_error($conn));
    

}
?>