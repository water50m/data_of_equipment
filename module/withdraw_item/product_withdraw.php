<?php
include '../save_history.php';

class Stock {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function searchById($table,$id) {
        $sql = "SELECT * FROM $table WHERE id = $id";
        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return "No data found or an error occurred.";
        }
    }

    public function addProduct($material_code, $name, $unit, $carry_over, $income, $expense, $remaining, $current, $image) {
        $dataString = "Material Code: $material_code, Name: $name, Unit: $unit, Carry Over: $carry_over, Income: $income, Expense: $expense, Remaining: $remaining, Current: $current, image: image ";
        
        $sql = "INSERT INTO withdraw_item(material_code, name, unit, carry_over, income, expense, remaining, current, image) VALUES ('$material_code', '$name', '$unit', '$carry_over', '$income', '$expense', '$remaining', '$current', '$image')";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            session_start();
            $user = $_SESSION['user_name'];
            saveToHistory("Add new item", '', $user, $dataString);
            echo "<script>alert('Save data success!');</script>";
            echo "<script>window.location='../../view/ui_withdraw_item.php'; </script>";
        } else {
            echo "<script>alert('Save data failed!');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }


// แก้------------------------------------------------------------------------------------------------------------------------------------------
    public function addProductWithdraw($matherial_id,$username, $material_code, $name, $unit, $image) {
        $dataString = "matherial_id:$matherial_id, Material Code: $material_code, Name: $name, Unit: $unit, image: $image ";
        
        $sql = "INSERT INTO withdraw(matherial_id,material_code, name, unit, image , who_do) VALUES ('$matherial_id','$material_code', '$name', '$unit', '$image' , '$username')";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            session_start();
            $user = $_SESSION['user_name'];
            saveToHistory("Add new item", '', $user, $dataString);
            echo "<script>alert('The product was successfully sent to the withdrawal page.');</script>";
            echo "<script>window.location='../../view/ui_withdraw_item.php'; </script>";
        } else {
            echo "<script>alert('Save data failed!');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }

    public function deleteProduct($product_id) {
        $sql = "DELETE FROM withdraw_item WHERE id = '$product_id'";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            session_start();
            $user = $_SESSION['user_name'];
            saveToHistory("Delete item with ID $product_id", '', $user, "Deleted Product ID: $product_id");
            echo "<script>alert('Product deleted successfully!');</script>";
            echo "<script>window.location='../view/ui_withdraw_item.php'; </script>";
        } else {
            echo "<script>alert('Failed to delete product');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }

    public function deleteProductWithdraw($product_id) {
        $sql = "DELETE FROM withdraw WHERE id = '$product_id'";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            session_start();
            $user = $_SESSION['user_name'];
            saveToHistory("Delete item with ID $product_id", '', $user, "Deleted Product ID: $product_id");
            // echo "<script>alert('Product remove successfully!');</script>";
            echo "<script>window.location='../../view/ui_withdraw.php'; </script>";
        } else {
            echo "<script>alert('Failed to delete product');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }

    public function updateProduct($product_id, $material_code, $name, $unit, $carry_over, $income, $expense, $remaining, $current, $image) {
        $dataString = "Material Code: $material_code, Name: $name, Unit: $unit, Carry Over: $carry_over, Income: $income, Expense: $expense, Remaining: $remaining, Current: $current";
    
        $updateImage = "";
        if (!empty($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
            $temp_image_path = $image['tmp_name'];
            $new_image_name = 'pr_' . uniqid() . '.' . pathinfo(basename($image['name']), PATHINFO_EXTENSION);
            $image_upload_path = "../img/" . $new_image_name;
            move_uploaded_file($temp_image_path, $image_upload_path);
            $updateImage = ", image = '$new_image_name'";
        }
    
        $sql = "UPDATE withdraw_item SET material_code = '$material_code', name = '$name', unit = '$unit', carry_over = '$carry_over', income = '$income', expense = '$expense', remaining = '$remaining', current = '$current' $updateImage WHERE id = '$product_id'";
        
        $result = mysqli_query($this->conn, $sql);
        
        if ($result) {
            session_start();
            $user = $_SESSION['user_name'];
            saveToHistory("Update item with ID $product_id", '', $user, $dataString);
            echo "<script>alert('Product updated successfully!');</script>";
            echo "<script>window.location='../view/fr_product.php'; </script>";
        } else {
            echo "<script>alert('Failed to update product');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }


    public function withdrawProduct($product_id, $expense) {
        $currentexpenseQuery = "SELECT remaining FROM withdraw_item WHERE id = '$product_id'";
        $currentexpenseResult = mysqli_query($this->conn, $currentexpenseQuery);
        $row = mysqli_fetch_assoc($currentexpenseResult);
        $currentexpense = $row['remaining'];
    
        if ($currentexpense < $expense) {
            echo "<script>alert('Insufficient expense available for withdrawal');</script>";
            return;
        }
    
        $newexpense = $currentexpense - $expense;
        $updateQuery = "UPDATE withdraw_item SET remaining = '$newexpense' WHERE id = '$product_id'";
        $updateResult = mysqli_query($this->conn, $updateQuery);
    
        if ($updateResult) {
            session_start();
            $user = $_SESSION['user_name'];
            $dataString = "Product ID: $product_id, expense Withdrawn: $expense";
            saveToHistory("Withdraw item with ID $product_id", '', $user, $dataString);
            echo "<script>alert('Product withdrawal successful!');</script>";
            echo "<script>window.location='../view/ui_withdraw.php'; </script>";
        } else {
            echo "<script>alert('Failed to withdraw product');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }


    public function addExpenseToProduct($product_id, $income) {
        $currentincomeQuery = "SELECT remaining FROM withdraw_item WHERE id = '$product_id'";
        $currentincomeResult = mysqli_query($this->conn, $currentincomeQuery);
        $row = mysqli_fetch_assoc($currentincomeResult);
        $currentincome = $row['remaining'];
        
        $newincome = $currentincome + $income;
        $updateQuery = "UPDATE withdraw_item SET remaining = '$newincome' WHERE id = '$product_id'";
        $updateResult = mysqli_query($this->conn, $updateQuery);
    
        if ($updateResult) {
            session_start();
            $user = $_SESSION['user_name'];
            $dataString = "Product ID: $product_id, income Added: $income";
            saveToHistory("Add income to item with ID $product_id", '', $user, $dataString);
            echo "<script>alert('income added successfully!');</script>";
            echo "<script>window.location='../view/ui_withdraw.php'; </script>";
        } else {
            echo "<script>alert('Failed to add income');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }

    public function increaseExpenseToProductWithdraw($product_id, $quantity) {
        $currentincomeQuery = "SELECT expense FROM withdraw WHERE id = '$product_id'";
        $currentincomeResult = mysqli_query($this->conn, $currentincomeQuery);
        $row = mysqli_fetch_assoc($currentincomeResult);
        $currentincome = $row['expense'];
        
        $newincome = $currentincome + $quantity;
        $updateQuery = "UPDATE withdraw SET expense = '$newincome' WHERE id = '$product_id'";
        $updateResult = mysqli_query($this->conn, $updateQuery);
    
        if ($updateResult) {
            session_start();
            $user = $_SESSION['user_name'];
            $dataString = "Product ID: $product_id, income Added: $quantity";
            saveToHistory("Add income to item with ID $product_id", '', $user, $dataString);
            echo "<script>alert('Increase expense successfully!');</script>";
            echo "<script>window.location='../../view/ui_withdraw.php'; </script>";
        } else {
            echo "<script>alert('Failed to add income');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }

    public function reduceExpenseToProductWithdraw($product_id, $quantity) {
        $currentincomeQuery = "SELECT expense FROM withdraw WHERE id = '$product_id'";
        $currentincomeResult = mysqli_query($this->conn, $currentincomeQuery);
        $row = mysqli_fetch_assoc($currentincomeResult);
        $currentincome = $row['expense'];
        
        $newincome = $currentincome - $quantity;
        $updateQuery = "UPDATE withdraw SET expense = '$newincome' WHERE id = '$product_id'";
        $updateResult = mysqli_query($this->conn, $updateQuery);
    
        if ($updateResult) {
            // session_start();
            // $user = $_SESSION['user_name'];
            // $dataString = "Product ID: $product_id, income Added: $quantity";
            // saveToHistory("Add income to item with ID $product_id", '', $user, $dataString);
            echo "<script>alert('Reduce expense successfully!');</script>";
            echo "<script>window.location='../../view/ui_withdraw.php'; </script>";
        } else {
            echo "<script>alert('Failed to add income');</script>";
            die("SQL query failed: " . mysqli_error($this->conn));
        }
    }   
    
    
    
    

    
}
?>
