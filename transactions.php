<?php 
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>OPMS | Transactions</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<div id="wel-des">
	<center>
<body style = "background-color: #122C60">
	<img src="photos/pays.png" width = 120>
	<center><h1>Transaction Details</h1></center>

	<center><table> 
		<center>
	<tr><th><p>	<?php $d = date("d/m/Y"); echo "Transaction date: " . $d . "<br>"; ?></p> </th></tr>
	<tr><th><?php  $t = date("h:i:sa"); echo "Time: " . $t;?></p></tr></th>
	<tr><th><p><b>Property Number:</b> <?php $br=$_SESSION['prop']; echo("$br") ?> </p></tr></th>
	<tr><th><p><b>Buyer Name:</b> <?php 

	$x=$_SESSION['user_name'];
	$query = "SELECT fname FROM SignINUP WHERE Email= '$x'";
	$query_run = mysqli_query($con, $query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$attempts = $resultarr["fname"];
	echo $attempts;

	?></tr></th>

	<?php
		$pro = $_SESSION['prop'];
		$query="SELECT SellerID FROM Property WHERE PropertyNumber='$pro'";
		$query_run = mysqli_query($con, $query);
		$resultarr = mysqli_fetch_assoc($query_run);
		$attempts = $resultarr["SellerID"];



		$query="SELECT Fname FROM SignINUP WHERE ClientNumber='$attempts'";
		$query_run = mysqli_query($con, $query);
		$resultarr = mysqli_fetch_assoc($query_run);
		$sid = $resultarr["Fname"];





		echo "<tr><th><p><b>Seller Name:</b> " .$sid ."</tr></th>";
	?>


	<?php 

	$ar=$_SESSION['area'];
	echo "<tr><th><p><b>Branch:</b> " .$ar ."</tr></th>";
	?>


	
	<?php 
	$br = $_SESSION['prop'];
	$query = "SELECT No_of_beds FROM Property WHERE PropertyNumber=$br";
	$query_run = mysqli_query($con, $query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$attempts = $resultarr["No_of_beds"];

	echo "<tr><th><p><b>Number of beds:</b> " .$attempts ."</tr></th>";
	?>

	<?php
	$br = $_SESSION['prop'];
	$query = "SELECT No_of_bathrooms FROM Property WHERE PropertyNumber=$br";
	$query_run = mysqli_query($con, $query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$attempts = $resultarr["No_of_bathrooms"];

	echo "<tr><th><p><b>Number of bathrooms:</b> " .$attempts."<tr><th>";

	?>

	<?php
	$br = $_SESSION['prop'];
	$query = "SELECT SQFT FROM Property WHERE PropertyNumber=$br";
	$query_run = mysqli_query($con, $query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$attempts = $resultarr["SQFT"];

	echo "<tr><th><p><b>SQFT:</b> " .$attempts."</tr></th>";
	?>


	<?php
	$br = $_SESSION['prop'];
	$query = "SELECT Price FROM Property WHERE PropertyNumber=$br";
	$query_run = mysqli_query($con, $query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$attempts = $resultarr["Price"];

	echo "<tr><th><p><b>Price:</b> " .$attempts. "EGP</tr></th>";
	?>

	
	</center>
</table>

	<form action="transactions.php" method="post">
	<center><button type="submit" name="branches" class="btn2">Back to branches</button></center>
	</form>
	<form action="transactions.php" method="post">
	<center><input type="submit" name="out" class="btn1" value ="Log Out"/></center>
	</form>



<?php
if(isset($_POST['out']))
{
	session_destroy();
	header('location:index.php');
}

else if(isset($_POST['branches']))
{
	header('location:branches.php');
}
?>


<?php
	$prop_num=$_SESSION['prop'];
	$branch_id = $_SESSION['brid'];



	$query = "SELECT Area FROM Branch WHERE BranchNumber = $branch_id";
	$result = $con->query($query);
	$resultarr = mysqli_fetch_assoc($result);
	$BranchName = $resultarr["Area"];

	$br = $_SESSION['prop'];

	$query = "SELECT Price FROM Property WHERE PropertyNumber = $br";
	$result = $con->query($query);
	$resultarr = mysqli_fetch_assoc($result);
	$price = $resultarr["Price"];


	$query = "SELECT S_R FROM Property WHERE PropertyNumber = $br";
	$result = $con->query($query);
	$resultarr = mysqli_fetch_assoc($result);
	$type = $resultarr["S_R"];


	$x = $_SESSION['user_name'];
	$query = "SELECT ClientNumber FROM SignINUP WHERE Email= '$x'";
	$query_run = mysqli_query($con, $query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$client_id = $resultarr["ClientNumber"];


	$query = "SELECT SellerID FROM Property WHERE PropertyNumber= '$br'";
	$query_run = mysqli_query($con, $query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$sid = $resultarr["SellerID"];

	if ($client_id == $sid)
	{
		echo "Error! You cant buy your own product!";
		header('location:BankAcc.php');

		// header('location:BankAcc.php');
	}

	else

	{
		?>
		<p>Payment Successfull!!!</p>
		<?php
		$query = "INSERT INTO Invoice (PropertyNum, BranchID, ClientID, PriceBuy, BranchName,type,TransactionDate,TransactionTime, SellerID) VALUES ('$prop_num', '$branch_id','$client_id','$price' ,'$BranchName', '$type','$d', '$t','$sid')";
		$query_run = mysqli_query($con, $query);


		$br = $_SESSION['prop'];
		$query="DELETE FROM Property WHERE PropertyNumber=$br";
		$query_run = mysqli_query($con, $query);
	}

?>


</div>

</body>
</center>
</html>
