<?php 

require_once 'core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
//echo $startDate;exit;
	//$date = DateTime::createFromFormat('m/d/Y',$startDate);

	//$start_date = $date->format("m/d/Y");

//echo $date;exit;

	$endDate = $_POST['endDate'];
	//$format = DateTime::createFromFormat('m/d/Y',$endDate);
	//$end_date = $format->format("Y-m-d");

	$sql = "SELECT * FROM invoice WHERE Invoice_Date >= '$startDate' AND Invoice_Date <= '$endDate'";
	$query = $connect->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:80%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		while ($result = $query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$result['Invoice_Date'].'</center></td>
				<td><center>'.$result['c_name'].'</center></td>
				<td><center>'.$result['Client_Contact_No'].'</center></td>
				<td><center>'.$result['Grand_Total'].'</center></td>
			</tr>';	
			$totalAmount += $result['Grand_Total'];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Total Amount</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	
	echo $table;

}

?>
<br><br><b>
<button onClick="onPrint()">Print Report</button></b>

<script>
                            function onPrint(){
                                window.print();
                            }
                            </script>