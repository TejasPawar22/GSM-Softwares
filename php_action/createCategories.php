<?php

require_once 'core.php';

$valid['success'] = ['success' => false, 'messages' => []];

if ($_POST) {
    $categoriesName = $_POST['categoriesName'];
    $categoriesStatus = $_POST['categoriesStatus'];

    $sql = "INSERT INTO categories (categories_name, categories_active, categories_status, company_id) 
	VALUES ('$categoriesName', '$categoriesStatus', 1, '$_SESSION[company_id]')";

    if ($connect->query($sql) === true) {
        $valid['success'] = true;
        $valid['messages'] = 'Successfully Added';
        header('location:fetchCategories.php');
    } else {
        $valid['success'] = false;
        $valid['messages'] = 'Error while adding the members';
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST
