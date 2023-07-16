<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        #invoice h1 {
            text-align: center;
        }

        #invoice .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        #invoice .invoice-details {
            display: flex;
            justify-content: space-between;
        }

        #invoice .invoice-details .left {
            flex: 1;
        }

        #invoice .invoice-details .right {
            flex: 1;
            text-align: right;
        }

        #invoice table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #invoice table th,
        #invoice table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        #invoice table th {
            background-color: #f5f5f5;
        }

        #invoice .total-section {
            margin-top: 20px;
            text-align: right;
        }

        #invoice .total-section strong {
            font-weight: bold;
        }

        #invoice .signature-section {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    $localhost = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'store1';
    $store_url = 'http://localhost/php-inventory/';
    // db connection
    $connect = new mysqli($localhost, $username, $password, $dbname);
    // check connection
    if ($connect->connect_error) {
        die('Connection Failed : ' . $connect->connect_error);
    } else {
        // echo "Successfully connected";
    }

    $user_id = $_SESSION['userId'];

    // Assuming you have established a database connection
    // Assuming you have established a database connection

    // Prepare the SQL statement
    $select_userDetails = "SELECT * FROM users WHERE user_id = '$user_id'";

    // Execute the query
    $result = mysqli_query($connect, $select_userDetails);

    // Check if any user details were found
    if (mysqli_num_rows($result) > 0) {
        // Fetch the user details
        $userDetails = mysqli_fetch_assoc($result);
        $select_CompDetails = "SELECT * FROM `company` WHERE reg_no = '$userDetails[company_id]'";

        $run = mysqli_query($connect, $select_CompDetails);

        $comp = mysqli_fetch_assoc($run);

        // ... other user details
        $comp_logo = $comp['company_logo'];

        $comp_sign = $comp['owner_sign_photo'];
        // Do something with the retrieved user details

        $sql = "SELECT GROUP_CONCAT(CONCAT(invoiceNo) SEPARATOR ',') AS invoiceNo , `id`, `invoiceNo`, `c_name`, `Invoice_Date`, `Client_Contact_No`, GROUP_CONCAT(CONCAT(product) SEPARATOR ',') AS product, GROUP_CONCAT(CONCAT(rate) SEPARATOR ',') AS rate, `Avail`, GROUP_CONCAT(CONCAT(Quantity) SEPARATOR ',') AS Quantity, GROUP_CONCAT(CONCAT(Total) SEPARATOR ',') AS Total, `Sub_Amount`, `Total_Amount`, `Discount`, `Grand_Total`, `GST`, `Paid_Amount`, `Due_Amount`, `Payment_Type`, `Payment_Status`, `Payment_Place` FROM invoice WHERE invoiceNo='$_GET[id]' GROUP BY invoiceNo ";

        $runquey = mysqli_query($connect, $sql);

        $invoiceData = mysqli_fetch_assoc($runquey);
        //$select_Comp = 'SELECT * FROM `company`WHERE reg_no="'.$row[''].'"';
        // Replace with your PHP code to retrieve the invoice details from the database
        $invoiceNo = $invoiceData['invoiceNo'];
        $cName = $invoiceData['c_name'];
        $invoiceDate = $invoiceData['Invoice_Date'];
        $clientContactNo = $invoiceData['Client_Contact_No'];

        $sequenceArray = explode(',', $invoiceData['product']);
        $products;
        foreach ($sequenceArray as $index) {
            $selectProduct = "SELECT * FROM `product` WHERE product_id=$index";
            //            echo $selectProduct;
            $runproduct = mysqli_query($connect, $selectProduct);
            while ($product = mysqli_fetch_assoc($runproduct)) {
                //$value += $index;
                $products[] = $product;
            }
        }

        $subAmount = $invoiceData['Sub_Amount'];
        $discount = $invoiceData['Discount'];
        $totalAmount = $invoiceData['Total_Amount'];
        $gst = $invoiceData['GST'];
        $grandTotal = $invoiceData['Grand_Total'];
        $paidAmount = $invoiceData['Paid_Amount'];
        $dueAmount = $invoiceData['Due_Amount'];
        $paymentType = $invoiceData['Payment_Type'];

        $payType;
        if ($paymentType == 1) {
            $payType = 'Cheque';
        }

        if ($paymentType == 2) {
            $payType = 'Cash';
        }

        if ($paymentType == 3) {
            $payType = 'Credit Card';
        }

        if ($paymentType == 4) {
            $payType = 'Phone Pe';
        }
        if ($paymentType == 5) {
            $payType = 'Google Pay';
        }
        if ($paymentType == 6) {
            $payType = 'Amazon Pay';
        }

        $paymentStatus = $invoiceData['Payment_Status'];

        $payStatus;

        if ($paymentStatus == 1) {
            $payStatus = 'Full Payment';
        }

        if ($paymentStatus == 2) {
            $payStatus = 'Advance Payment';
        }

        if ($paymentStatus == 3) {
            $payStatus = 'No Payment';
        }

        $paymentPlace = $invoiceData['Payment_Place'];

        $payLocation;

        if ($paymentPlace == 1) {
            $payLocation = 'In India';
        }

        if ($paymentPlace == 2) {
            $payLocation = 'Out Of India';
        }

        // Display the invoice details
    } else {
        // No user found with the specified user_id
        echo 'no user found';
    }
    ?>
    <div id="invoice">
        <h1>Invoice</h1>

        <div class="logo">
            <img src="../company_details/<?php echo $comp_logo; ?>" alt="Invoice Logo" width="150">
        </div>

        <div class="invoice-details">
            <div class="left">
                <p>Invoice No: <?php echo $invoiceNo; ?></p>
                <p>Client Name: <?php echo $cName; ?></p>
                <p>Invoice Date: <?php echo $invoiceDate; ?></p>
                <p>Client Contact No: <?php echo $clientContactNo; ?></p>
            </div>
            <div class="right">
                <p>Payment Type: <?php echo $payType; ?></p>
                <p>Payment Status: <?php echo $payStatus; ?></p>
                <p>Payment Place: <?php echo $payLocation; ?></p>
            </div>
        </div>

        <table>
            <tr>
                <th>Product</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php foreach ($products as $index => $product): ?>
        <tr>
            <td style="display:flex;justify-content:space-between">
                <?php echo $product['product_name']; ?>
                <img width="100" src="../assets/myimages/<?php echo $product[
                    'product_image'
                ]; ?>" alt="">
            </td>
            <td><?php echo $product['rate']; ?></td>
            <td><?php
            $sequenceArray = explode(',', $invoiceData['Quantity']);

            echo $sequenceArray[$index];
            ?></td>
            <td><?php echo $product['rate'] * $sequenceArray[$index]; ?> </td>
        </tr>
    <?php endforeach; ?>
        </table>

        <div class="total-section">
            <p><strong>Sub Amount:</strong> <?php echo $subAmount; ?></p>
            <p><strong>Discount:</strong> <?php echo $discount; ?></p>
            <p><strong>Total Amount:</strong> <?php echo $totalAmount; ?></p>
            <p><strong>GST:</strong> <?php echo $gst; ?></p>
            <p><strong>Grand Total:</strong> <?php echo $grandTotal; ?></p>
            <p><strong>Paid Amount:</strong> <?php echo $paidAmount; ?></p>
            <p><strong>Due Amount:</strong> <?php echo $dueAmount; ?></p>
        </div>

        <div class="signature-section">
        <div class="logo " style="text-align:right">
            <img src="../company_details/<?php echo $comp_sign; ?>" alt="Invoice Logo" width="150">
        </div>
            <p>Authorized Signature</p>
        </div>
    </div>


    <button onClick="generatePDF()">Print</button>

    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script>

function generatePDF(){

   window.print();
}
   </script>
    
</body>
</html>
