<?php
include("../condb.php");
include 'product_withdraw.php';

$product = new Stock($conn); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['add_product']))  {
        $material_code = $_POST['material_code'];
        $name = $_POST['name'];
        $unit = $_POST['unit'];
        $carry_over = $_POST['carry_over'];
        $income = $_POST['income'];
        $expense = $_POST['expense'];
        $remaining = $_POST['remaining'];
        $current = $_POST['current'];

        $temp_image_path = $_FILES['img']['error'];
        $new_image_name = 'test_pr_' . uniqid() . '.' . pathinfo(basename($_FILES['img']['name']), PATHINFO_EXTENSION);
        $image_upload_path = "../../img/" . $new_image_name;
        // echo 'dddddddddddddddddddd';
        // echo $image_upload_path;
        // echo 'dddddddddddddddddddd';
        // var_dump($temp_image_path);
        // echo 'dddddddddddddddd';
        move_uploaded_file($temp_image_path, $image_upload_path);
       

        $product->addProduct($material_code, $name, $unit, $carry_over, $income, $expense, $remaining, $current, $new_image_name);
    } else if (isset($_POST['delete_product'])) {
    
        $product_id = $_POST['product_id'];

        $product->deleteProduct($product_id);
    } else if (isset($_POST['update_product'])) {
   
        $material_code = $_POST['material_code'];
        $name = $_POST['name'];
        $unit = $_POST['unit'];
        $carry_over = $_POST['carry_over'];
        $income = $_POST['income'];
        $expense = $_POST['expense'];
        $remaining = $_POST['remaining'];
        $current = $_POST['current'];

        $image = $_FILES['image'];  

        $product->updateProduct($product_id, $material_code, $name, $unit, $carry_over, $income, $expense, $remaining, $current, $image);
    } else if (isset($_POST['withdraw_product'])) {
        $product_id = $_POST['product_id'];
        $expense = $_POST['expense'];

        $product->withdrawProduct($product_id, $expense);
    } else if (isset($_POST['add_expense_product'])) {
        
        $product_id = $_POST['product_id'];
        $expense = $_POST['expense'];

        $product->addexpenseToProduct($product_id, $expense);
    }else if (isset($_POST['id_withdraw'])){
        $id_withdraw = $_GET['id'];
        session_start();
        $username = $_SESSION['user_name'];


        $data_withdraw = $product->searchById('withdraw_item',$id_withdraw);

        $product->addProductWithdraw($data_withdraw['id'],$username, $data_withdraw['material_code'], $data_withdraw['name'], $data_withdraw['unit'], $data_withdraw['expense'], $data_withdraw['image']);

    }else if (isset($_POST['id_remove'])){
        $id_withdraw = $_GET['id'];
        $product->deleteProductWithdraw( $id_withdraw);
       
    }else if (isset($_POST['increase'])){
        $id_withdraw = $_GET['id'];
        $quantity = $_GET['quantity'];

        $peoduct->increaseExpenseToProductWithdraw($id_withdraw, $quantity);

    }else if (isset($_POST['reduce'])){
        $id_withdraw = $_GET['id'];
        $quantity = $_GET['quantity'];

        $peoduct->reduceExpenseToProductWithdraw($id_withdraw, $quantity);
    }else if (isset($_POST['Order'])){
        $id_withdraw = $_GET['id'];
        $quantity = $_GET['quantity'];

        $peoduct->reduceExpenseToProductWithdraw($id_withdraw, $quantity);
    }
}
?>
