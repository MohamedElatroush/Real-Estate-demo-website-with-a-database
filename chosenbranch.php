<?php 
	session_start();
	require 'dbconfig/config.php';
?>



<!DOCTYPE html>
<html>
<head>
	<title>OPMS</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<div id="wel-des2">
<body style = "background-color: #122C60">



<center><h1> Welcome to <?php echo $_SESSION['area']; ?> branch </h1> </center>

<center><p>-----------------------------------</p></center>


<table align="center" border="1px" style="width:600px; line-height: 30px">
		<tr>
			<center><h2>Properties for sale</h2></center>
		</tr>	


		<?php
			
			$a=$_SESSION['area'];

			$query = "SELECT BranchNumber FROM Branch WHERE (Area='$a')";
			$query_run= $con->query($query);
			$result = mysqli_fetch_assoc($query_run);
			$attempt = $result["BranchNumber"];

			$query="SELECT * FROM Property WHERE BranchID = '$attempt'"; 
			$result = $con->query($query);
			while($rows=mysqli_fetch_assoc($result))
				{
					?>
					<tr>
						<td><p>Price: </p><?php echo $rows['Price']; ?></td>
						<td><p>Property Indx: </p><?php echo $rows['PropertyNumber'];?></td>
						<td><p>Year Built: </p><?php echo $rows['YEAR']; ?></td>
						<td><p>Type: </p><?php echo $rows['Type']; ?></td>
						<td><p>Address: </p><?php echo $rows['Address']; ?></td>
						<td><p>Sqft: </p><?php echo $rows['SQFT']; ?></td>
						<td><p>Beds: </p><?php echo $rows['No_of_beds']; ?></td>
						<td><p>Bathrooms: </p><?php echo $rows['No_of_bathrooms']; ?></td>
						<td> <img src= <?php echo $rows['img']; ?> width=200></td>
					<?php
				}

		?>
</table>

<br><br>
		<form action="chosenbranch.php" method="post">
		<center><label><b>Enter property index you would like to buy</b></label></center>
		<center><input type="text" class="sp" placeholder="1,2 .. etc" name="numb" required></center>
		<center><input type="submit" class="btn2" name="indx" value="Buy now" required></center>
		</form>	

		<form action="chosenbranch.php" method = post>
			<center><input type="submit" class="btn2" name="sell" value="Sell a property"></center>
		</form>





<center>
<form action="chosenbranch.php" method="post">
<input type="submit" name="cb" class="btn2" value ="Change branch"/>
</form>
</center>


<?php 
if(isset($_POST['cb']))
{
	header('location:branches.php');
}

else if (isset($_POST['sell']))
{
	$brid=$attempt;
	$_SESSION['brid'] =$brid;
	header('location:sell_property.php');
}


else if (isset($_POST['indx']))
{  
		$ar =$_SESSION['area'];
		$query="SELECT BranchNumber FROM Branch WHERE Area='$ar'";
		$query_run=mysqli_query($con,$query);
		$resultarr = mysqli_fetch_assoc($query_run);
		$id = $resultarr["BranchNumber"];


		$query="SELECT (PropertyNumber) FROM Property WHERE BranchID=$id ";
		$query_run = mysqli_query($con, $query);
		$resultarr = mysqli_fetch_assoc($query_run);
		$attempts = $resultarr["number"];
		$x = $_POST["numb"];

		$_SESSION['brid'] = $id;		
		$_SESSION['prop'] = $x ; //contains the sold property number
		header('location:BankAcc.php');
}

?>

</div>

</body>
</html>