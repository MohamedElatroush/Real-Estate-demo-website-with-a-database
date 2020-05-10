<?php 
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>OPMS | Bank Account</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<div id="wel-des">
<body style = "background-color: #122C60">


	<center>
	<form action="BankAcc.php" method="post">
	<br>
	<img src="photos/pay.png" width=100 height=100>
	<h2>Payment</h2>
	
	<label for="cardn">Name on Card</label> <br>
	<input type="text" id="cardn" name="cardname" placeholder="Mohamed Elatroush" required> 

	<br> 

	<label for="ccn">Credit Card Number</label>
	<input type="text" id="ccn" name="ccnumber" placeholder="1111-2222-3333-4444" required>  

	<br> 

	<label for="cvv">CVV</label>
	<br>
	<input type="text" id="cvv" name="cvvnum" placeholder="452" required>  

	<br> 

	<label for="exmy">Expiration (mm/yy)</label>
	<br>
	<input type="text" id="exmy" name="exmonth" placeholder="05/2019" required>  
	<br>

	<br>	
       <center><button type="submit" name="buy" class = "check">Checkout</button></center>
</form>
		<form action="BankAcc.php" method = post>
			<center><input type="submit" class="btn2" name="out" value="Log Out"></center>
		</form>

<?php
	if(isset($_POST['out']))
	{
		session_destroy();
		header('location:index.php');
	}

	else if(isset($_POST['buy']))
	{
		
		header('location:transactions.php');
	}


?>

</div>
</center>
</body>
</html>