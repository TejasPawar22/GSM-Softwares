<?php

require_once 'core.php';

$valid['success'] = ['success' => false, 'messages' => []];

if ($_POST) {
    $brandName = $_POST['brandName'];
    $brandStatus = $_POST['brandStatus'];

    $sql = "INSERT INTO brands (brand_name, brand_active, brand_status, company_id) VALUES ('$brandName', '$brandStatus', 1,'$_SESSION[company_id]')";

    if ($connect->query($sql) === true) {
        $valid['success'] = true;
        $valid['messages'] = 'Successfully Added';
        header('location:fetchBrand.php');
    } else {
        $valid['success'] = false;
        $valid['messages'] = 'Error while adding the members';
        header('location:../add-brand.php');
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
