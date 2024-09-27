<?php
include 'condb.php';

$pro_id=$_POST['Pid'];
$p_name = $_POST['Pname'];
$p_type = $_POST['typeid'];
$p_price = $_POST['Pprice'];
$num = $_POST['Pamount'];
$loc = $_POST['Plocation'];
$note = $_POST['Pnote'];


if (isset($_FILES['filename']['tmp_name']) && is_uploaded_file($_FILES['filename']['tmp_name'])) {
    $temp_image_path = $_FILES['filename']['tmp_name'];
    
    
    $new_image_name = 'pr_' . uniqid() . '.' . pathinfo(basename($_FILES['filename']['name']), PATHINFO_EXTENSION);
    
    
    $image_upload_path = "../img/" . $new_image_name;
    
    
    move_uploaded_file($temp_image_path, $image_upload_path);
    $sqlimg="UPDATE product set image='$new_image_name'  WHERE pro_id='$pro_id'";
    mysqli_query($conn,$sqlimg);
    
}
$data = "SELECT * FROM product WHERE pro_id='$pro_id'";
$hand = mysqli_query($conn,$data);
$row  = mysqli_fetch_array($hand);

$sql="UPDATE product set pro_name='$p_name',type_id='$p_type',price='$p_price',amount='$num',location='$loc',note='$note' WHERE pro_id='$pro_id'";
$result=mysqli_query($conn,$sql);



if(!empty($pro_id)){
    
    

    
    $before_edit = 'before  ';
    $after_edit = 'after  ';
    if ($row['pro_id'] != $pro_id ){}else{
        $before_edit = implode(', ', array($before_edit,'ID:'.$row['pro_id']));
        $after_edit = implode(', ', array($after_edit,'ID:'.$pro_id));
     

        // $before_edit['ID: ']= $row['pro_id'];
        // $after_edit['ID: ']=$pro_id;
    } if ($row['pro_name'] == $p_name ){}else{
        $before_edit = implode(', ', array($before_edit,'Name: '.$row['pro_name']));
        $after_edit = implode(', ', array($after_edit,'Name: '.$p_name));
        // array_push($before_edit,'Name: '.$row['pro_name']);
        // array_push($after_edit,'Name: '.$p_name);

        // $before_edit['Name: ']= $row['pro_name'];
        // $after_edit['Name: ']=$p_name;
    } if ($row['type_id'] == $p_type ){}else{
        
        include 'connectPTtable.php';
        $oldname = TypeidToname($row['type_id']);
        $newname = TypeidToname($p_type);

        $before_edit = implode(', ', array($before_edit,'Type: '.$oldname));
        $after_edit = implode(', ', array($after_edit,'Type: '.$newname));
        // array_push($before_edit,'Type: '.$oldname);
        // array_push($after_edit,'Type: '.$newname);

        // $before_edit['Type: ']= $oldname;
        // $after_edit['Type: ']=$newname;
    } if ($row['price'] == $p_price ){}else{

        $before_edit = implode(', ', array($before_edit,'Price: '.$row['price']));
        $after_edit = implode(', ', array($after_edit,'Price: '.$p_price));
        // array_push($before_edit,'Price: '.$row['price']);
        // array_push($after_edit,'Price: '.$p_price);


        // $before_edit['Price: ']= $row['price'];
        // $after_edit['Price: ']=$p_price;
    }if ($row['amount'] == $num ){}else{
        $before_edit = implode(', ', array($before_edit,'Amount: '.$row['amount']));
        $after_edit = implode(', ', array($after_edit,'Amount: '.$num));
        // array_push($before_edit,'Amount: '.$row['amount']);
        // array_push($after_edit,'Amount: '.$num);

        // $before_edit['Amount: ']= $row['amount'];
        // $after_edit['Amount: ']=$num;
    }if ($row['location'] == $loc ){}else{
        $before_edit = implode(', ', array($before_edit,'Location: '.$row['location']));
        $after_edit = implode(', ', array($after_edit,'Location: '.$loc));
        // array_push($before_edit,'Location: '.$row['location']);
        // array_push($after_edit,'Location: '.$loc);

        // $before_edit['Location: ']= $row['location'];
        // $after_edit['Location: ']=$loc;
    }if ($row['Note'] == $note ){}else{
        $before_edit = implode(', ', array($before_edit,'Note: '.$row['Note']));
        $after_edit = implode(', ', array($after_edit,'Note: '.$note));
        // array_push($before_edit,'Note: '.$row['Note']);
        // array_push($after_edit,'Note: '.$note);


        // $before_edit['Note: ']= $row['Note'];
        // $after_edit['Note: ']=$note;
    }
    
    
    session_start();
    $user = $_SESSION['user_name'];
    include 'save_history.php';
    saveToHistory("Edit item",$before_edit,$user,$after_edit);

    

    // $dataString1 = implode(' ', array('before -> ','ID:'.$row['pro_id'],'name: '.$row['pro_name'], ' type: '.$typename, ' price: '.$p_price, ' amount: '.$num, ' location: '.$loc, ' note: '.$note));


    echo "<script>alert('Updated data success!');</script>";
    echo "<script>window.location='../view/show_product.php'; </script>";
}else{
    echo "<script>alert('Save data failed!');</script>";
    die("SQL query failed: " . mysqli_error($conn));
}
?>