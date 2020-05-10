<?php 
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>OPMS | Search</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style = "background-color: #122C60">
<div id="wel-des2">
<center><h1>User transaction history</h1><br></center>
<center><h3>User: <?php echo $_SESSION['user_name']?></h3></center>

<form action="history.php" method="post">
<center>
<label for="ue"><b>User Email</b><br></label>
<input type="text" class="sp" name="e" placeholder="elatroush@hotmail.com" required>
<input type="submit" name="ue" class="btn2" value="Search"/><br></center>
<br>
</form>




<center>
<form action="branches.php" method="post">
<input type="submit" name="back" class="btn2" value ="Back"/>
</form></center>




<?php
if(isset($_POST['ue']))
{
$email = $_POST['e'];
$query="SELECT ClientNumber FROM SignINUP WHERE Email='$email'";
$result = $con->query($query);
$resultarr = mysqli_fetch_assoc($result);

$cn = $resultarr["ClientNumber"];



$query = "SELECT * FROM Invoice WHERE ClientID = $cn";
$query_run = $con->query($query);
// $resultarr = mysqli_fetch_assoc($query_run);
// $l = $resultarr["Reference_number"];

?>

<h2><center>Transaction history for: <?php echo $email ?></center></h2>

<?php

		$query2="SELECT fname FROM SignINUP WHERE ClientNumber=$cn";
		$query_run2=$con->query($query2);
		$resultarr2 = mysqli_fetch_assoc($query_run2);
		$BuyerName = $resultarr2["fname"];





while($rows=mysqli_fetch_assoc($query_run))
{
	?>

	<center><br><table align="center" border="1px" style="width:300px; line-height: 30px">
	<tr>
		<th colspan="4"></th></center>
	</tr>	
		<t>
			<th><center>Transactions references</th></center>
			<th><center>Property Index</th></center>
			<th><center>Price</th></center>
			<th><center>Buyer Name</center></th>
			<th><center>Seller Name</center></th>
			<th><center>Branch</center></th>
			<th><center>Type [s:sold, r:rent]</center></th>
			<th><center>Transaction Date</center></th>
			<th><center>Transaction Time</center></th>

		</t>


	<tr>
		<td><center><?php echo "<b>" .$rows['Reference_number']; ?></center></td>
		<td><center><?php echo "<b>".$rows['PropertyNum']; ?></center></td>
		<td><center><?php echo "<b>EGP".$rows['PriceBuy']; ?></center></td>
		<td><center><?php echo "<b>" .$BuyerName; ?></center></td>
		<?php
		$seller = $rows['SellerID'];
		$query3="SELECT fname FROM SignINUP WHERE ClientNumber='$seller'";
		$query_run3=$con->query($query3);
		$resultarr3 = mysqli_fetch_assoc($query_run3);
		$Seller = $resultarr3["fname"];
		?>
		<td><center><?php echo "<b>" .$Seller ?></center></td>
		<td><center><?php echo "<b>" .$rows['BranchName']; ?></center></td>
		<td><center><?php echo "<b>" .$rows['type']; ?></center></td>
		<td><center><?php echo "<b>" .$rows['TransactionDate']; ?></center></td>
		<td><center><?php echo "<b>" .$rows['TransactionTime']; ?></center></td>

	</tr>

	<br>
	<?php
	
}


}


?>
 </center> 
</table>

</div>
</body>
</html>
