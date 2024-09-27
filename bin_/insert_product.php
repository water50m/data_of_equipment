<?php
include('condb.php');

$p_name = $_POST['Pname'];
$p_type = $_POST['typeid'];
$p_price = $_POST['Pprice'];
$num = $_POST['Pamount'];
$loc = $_POST['Plocation'];
$note = $_POST['Pnote'];


include 'save_history.php';
include 'connectPTtable.php';
$typename = TypeidToname($p_type);

$dataString = implode(' ', array('name: '.$p_name, ' type: '.$typename, ' price: '.$p_price, ' amount: '.$num, ' location: '.$loc, ' note: '.$note));



if (isset($_FILES['filename']['tmp_name']) && is_uploaded_file($_FILES['filename']['tmp_name'])) {
    $temp_image_path = $_FILES['filename']['tmp_name'];
    
    // สร้างชื่อไฟล์ใหม่
    $new_image_name = 'pr_' . uniqid() . '.' . pathinfo(basename($_FILES['filename']['name']), PATHINFO_EXTENSION);
    
    // ตำแหน่งที่คุณต้องการจะบันทึกไฟล์
    $image_upload_path = "../img/" . $new_image_name;
    
    // ย้ายไฟล์ไปยังตำแหน่งที่คุณต้องการ
    
    
    
} else {
    echo "Please upload an image.";
}




$sql = "INSERT INTO product(pro_name,type_id,price,amount,image,location,note) VALUE('$p_name','$p_type','$p_price','$num','$new_image_name','$loc','$note')";
$result=mysqli_query($conn,$sql);
if($result){
    
    session_start();
    $user = $_SESSION['user_name'];
    saveToHistory("Add new item", '
    ',$user,$dataString);
    move_uploaded_file($temp_image_path, $image_upload_path);
    echo "<script>alert('Save data success!');</script>";
    echo "<script>window.location='../view/fr_product.php'; </script>";
}else{
    echo "<script>alert('Save data failed!');</script>";
    die("SQL query failed: " . mysqli_error($conn));
}
?>