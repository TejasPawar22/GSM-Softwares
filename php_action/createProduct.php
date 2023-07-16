<?php

require_once 'core.php';

$valid['success'] = ['success' => false, 'messages' => []];

if ($_POST) {
    $productName = $_POST['productName'];
    //echo $productName ;exit;
    $productImage = $_POST['productImage'];
    $quantity = $_POST['quantity'];
    $rate = $_POST['rate'];
    $brandName = $_POST['brandName'];
    $categoryName = $_POST['categoryName'];
    $productStatus = $_POST['productStatus'];

    $product_purity = $_POST['product_purity'];
    $product_type = $_POST['product_type'];
    $product_code = $_POST['product_code'];
    $product_weight = $_POST['product_weight'];
    $product_gm = $_POST['product_gm'];
    $product_date = $_POST['product_date'];

    //$type = explode('.', $_FILES['productImage']['name']);
    $image = $_FILES['productImage']['name'];
    $target = '../assets/myimages/' . basename($image);

    if (move_uploaded_file($_FILES['productImage']['tmp_name'], $target)) {
        // @unlink("uploadImage/Profile/".$_POST['old_image']);
        //echo $_FILES['image']['tmp_name'];
        //cho $target;exit;
        $msg = 'Image uploaded successfully';
        echo $msg;
    } else {
        $msg = 'Failed to upload image';
        echo $msg;
        exit();
    }

    $sql = "INSERT INTO product (product_name, product_image, brand_id, categories_id, quantity,`product_purity`, `product_type`, `product_code`, `product_weight`, `product_gm`, `product_date`, rate, active, status, company_id) 
				VALUES ('$productName', '$image', '$brandName', '$categoryName', '$quantity', '$product_purity', '$product_type', '$product_code','$product_weight', '$product_gm', '$product_date', '$rate', '$productStatus', 1, '$_SESSION[company_id]')";

    if ($connect->query($sql) === true) {
        $valid['success'] = true;
        $valid['messages'] = 'Successfully Added';
        header('location:fetchProduct.php');
    } else {
        $valid['success'] = false;
        $valid['messages'] = 'Error while adding the members';
        header('location:../add-product.php');
    }

    // /else
    // if
    // if in_array

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
