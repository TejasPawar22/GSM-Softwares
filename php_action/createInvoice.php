<link rel="stylesheet" href="../assets/css/popup_style.css"> 

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve input values
    $invoiceNo = $_POST['invoiceNo'];
    $cName = $_POST['clientName'];
    $invoiceDate = $_POST['orderDate'];
    $clientContactNo = $_POST['clientContact'];
    $productNames = $_POST['productName'];
    $rateValues = $_POST['rateValue'];
    $quantities = $_POST['quantity'];
    $totalValues = $_POST['totalValue'];
    $subAmount = $_POST['subTotalValue'];
    $totalAmount = $_POST['totalAmountValue'];
    $discount = $_POST['discount'];
    $grandTotal = $_POST['grandTotalValue'];
    $gst = $_POST['vatValue'];
    $paidAmount = $_POST['paid'];
    $dueAmount = $_POST['dueValue'];
    $paymentType = $_POST['paymentType'];
    $paymentStatus = $_POST['paymentStatus'];
    $paymentPlace = $_POST['paymentPlace'];

    // Process and store values
    $numOfProducts = count($productNames);
    for ($i = 0; $i < $numOfProducts; $i++) {
        $productName = $productNames[$i];
        $rateValue = $rateValues[$i];
        $quantity = $quantities[$i];
        $totalValue = $totalValues[$i];

        // Insert the values into the database (replace with your database connection code)
        // Example using PDO:
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'store1';

        try {
            $conn = new PDO(
                "mysql:host=$servername;dbname=$dbname",
                $username,
                $password
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO invoice (`invoiceNo`, c_name, Invoice_Date, Client_Contact_No, product, rate, Quantity, Total, Sub_Amount, Total_Amount, Discount, Grand_Total, GST, Paid_Amount, Due_Amount, Payment_Type, Payment_Status, Payment_Place)
                    VALUES (:invoiceNo, :cName, :invoiceDate, :clientContactNo, :productName, :rateValue, :quantity, :totalValue, :subAmount, :totalAmount, :discount, :grandTotal, :gst, :paidAmount, :dueAmount, :paymentType, :paymentStatus, :paymentPlace)";
            //print_r($_POST);
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':invoiceNo', $invoiceNo);
            $stmt->bindParam(':cName', $cName);
            $stmt->bindParam(':invoiceDate', $invoiceDate);
            $stmt->bindParam(':clientContactNo', $clientContactNo);
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':rateValue', $rateValue);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':totalValue', $totalValue);
            $stmt->bindParam(':subAmount', $subAmount);
            $stmt->bindParam(':totalAmount', $totalAmount);
            $stmt->bindParam(':discount', $discount);
            $stmt->bindParam(':grandTotal', $grandTotal);
            $stmt->bindParam(':gst', $gst);
            $stmt->bindParam(':paidAmount', $paidAmount);
            $stmt->bindParam(':dueAmount', $dueAmount);
            $stmt->bindParam(':paymentType', $paymentType);
            $stmt->bindParam(':paymentStatus', $paymentStatus);
            $stmt->bindParam(':paymentPlace', $paymentPlace);

            $stmt->execute();?>


<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p>Invoice Added Successfully! </p>
    <p>
      <a href="Order.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>

<?php
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        $conn = null;
    }
}
?>
