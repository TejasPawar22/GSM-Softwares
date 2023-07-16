<?php include './constant/layout/head.php'; ?>
<?php include './constant/layout/header.php'; ?>

<?php include './constant/layout/sidebar.php'; ?>

<?php
include './constant/connect';
session_start();
$user = $_SESSION['userId'];
$sql =
    "SELECT GROUP_CONCAT(CONCAT(invoiceNo) SEPARATOR ',') AS invoiceNo , `id`, `invoiceNo`, `c_name`, `Invoice_Date`, `Client_Contact_No`, GROUP_CONCAT(CONCAT(product) SEPARATOR ',') AS concatenatedData, GROUP_CONCAT(CONCAT(rate) SEPARATOR ',') AS rate, `Avail`, GROUP_CONCAT(CONCAT(Quantity) SEPARATOR ',') AS Quantity, GROUP_CONCAT(CONCAT(Total) SEPARATOR ',') AS Total, `Sub_Amount`, `Total_Amount`, `Discount`, `Grand_Total`, `GST`, `Paid_Amount`, `Due_Amount`, `Payment_Type`, `Payment_Status`, `Payment_Place` FROM invoice GROUP BY invoiceNo";
//echo $sql;
    $result = $connect->query($sql);
?>
       <div class="page-wrapper">
            
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"> View Invoice</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">View Invoice</li>
                    </ol>
                </div>
            </div>
            
            
            <div class="container-fluid">
             
                
                
                 <div class="card">
                            <div class="card-body">
                              
                            <a href="add-order.php"><button class="btn btn-primary">Add Invoice</button></a>
                         
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                              <th>#</th>
                        <th>Invoice Date</th>
                        <th>Client Name</th>
                        <th>Contact</th>
                        <th>Total Invoice Item</th>
                        <th>Payment Status</th>
                                                <th>Action</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                        <?php foreach ($result as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row[
                                                'Invoice_Date'
                                            ]; ?></td>
                                             <td><?php echo $row[
                                                 'c_name'
                                             ]; ?></td>
                                              <td><?php echo $row[
                                                  'Client_Contact_No'
                                              ]; ?></td>
                                               <td><?php
                                               $sequenceArray = explode(
                                                   ',',
                                                   $row['Quantity']
                                               );
                                               $value = 0;
                                               foreach (
                                                   $sequenceArray
                                                   as $index
                                               ) {
                                                   $value += $index;
                                               } // Display the calculated value
                                               echo $value;
                                               ?></td>
                                            <td><?php if (
                                                $row['Payment_Status'] == 1
                                            ) {
                                                $paymentStatus =
                                                    "<label class='label label-success' ><h4>Full Payment</h4></label>";
                                                echo $paymentStatus;
                                            } elseif (
                                                $row['Payment_Status'] == 2
                                            ) {
                                                $paymentStatus =
                                                    "<label class='label label-danger'><h4>Advance Payment</h4></label>";
                                                echo $paymentStatus;
                                            } else {
                                                $paymentStatus =
                                                    "<label class='label label-warning'><h4>No Payment</h4></label>";
                                                echo $paymentStatus;
                                            }
                                            // /els
                                            ?></td>
                                            <td>
            
                                                <a href="phpinventory/printInvoice.php?id=<?php echo $row[
                                                    'invoiceNo'
                                                ]; ?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fa fa-download"></i></button></a>
                                              

             
                                                <a href="php_action/removeOrder.php?id=<?php echo $row[
                                                    'order_id'
                                                ]; ?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></button></a>
                                           
                                                
                                                </td>
                                        </tr>
                                     
                                    </tbody>
                                   <?php } ?>
                               </table>
                                </div>
                            </div>

                            
                        </div>

                                   

                        
<?php include './constant/layout/footer.php'; ?>
