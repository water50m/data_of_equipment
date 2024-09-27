<?php
function TypeidToname($type_id) {
    global $conn; 
    
    $sql3 = "SELECT * FROM type1  WHERE type_id = '$type_id'";
    $hand2 = mysqli_query($conn, $sql3);
    // ${$type_id . "_num"} = 0;
    // ใช้ลูป while เพื่อแสดงผลลัพธ์
    $product = mysqli_fetch_array($hand2);
    return $product['type_name'];

}
   
?>