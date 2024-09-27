<?php
include '../condb.php';
include '../save_history.php';
// include 'connectPTtable.php';

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
$type_id = $_POST['type_id'];
$group_id = $_POST['group_id'];

$sql =$pdo->prepare( "SELECT group_name FROM group_type WHERE group_id = :group");
$sql2 =$pdo->prepare( "SELECT type_name FROM type_durable_articles WHERE type_id = :type");
$sql->bindParam(":type", $type_id, PDO::PARAM_STR);
$sql2->bindParam(":group", $group_id, PDO::PARAM_STR);
$sql->execute();
$sql2->execute();
$type = $sql->fetch(PDO::FETCH_ASSOC);
$group = $sql2->fetch(PDO::FETCH_ASSOC);


$dataString = implode(' ', array('name: '.$name, ' asset: '.$asset, ' asset2: '.$asset2, ' status: '.$status,
 ' ole articles: '.$old_articles, ' Date received: '.$Date_received, ' expenditure: '.$expenditure,
  ' how get: '.$how_get, ' money: '.$money, ' balance: '.$balance, ' organization: '.$organization, ' note: '.$note, 'type'.$type,'group'.$group));



if (isset($_FILES['filename']['tmp_name']) && is_uploaded_file($_FILES['filename']['tmp_name'])) {
    $temp_image_path = $_FILES['filename']['tmp_name'];
    
    // สร้างชื่อไฟล์ใหม่
    $new_image_name = 'pr_' . uniqid() . '.' . pathinfo(basename($_FILES['filename']['name']), PATHINFO_EXTENSION);
    
    // ตำแหน่งที่คุณต้องการจะบันทึกไฟล์
    $image_upload_path = "../../img/" . $new_image_name;
    
    // ย้ายไฟล์ไปยังตำแหน่งที่คุณต้องการ

    
    
    
} 




$sql = "INSERT INTO equipment_inspection_report(Item,asset_number,asset_number2,status,old_articles_number,date_received,expenditure,how_get,money,balance,agency,note,img,location,type_id,group_id) 
VALUES('$name','$asset','$asset2','$status','$old_articles','$Date_received','$expenditure','$how_get','$money','$balance','$organization','$note','$new_image_name','$location','$type_id','$group_id')";
$result=mysqli_query($conn,$sql);
if($result){
    
    session_start();
    $user = $_SESSION['user_name'];
    saveToHistory("Add new item",'',$user,$dataString);
    move_uploaded_file($temp_image_path, $image_upload_path);
    echo "<script>alert('Save data success!');</script>";
    echo "<script>window.location='../../view/Equepment.php'; </script>";
    
}else{

    echo "<script>alert('Save data failed!');</script>";
    echo "<script>window.location='../../view/Equepment.php'; </script>";
    

    // die("SQL query failed: " . mysqli_error($conn));
    

}
?>