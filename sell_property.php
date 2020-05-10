<?php 
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>OPMS | Sell</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body style = "background-color: #122C60">
	<div id="wel-des">
	<center><h1> Sell a property in <?php echo $_SESSION['area'] ?> branch</h1></center>


		<form action="sell_property.php" method="post">
			<center><label for="yr"><b>Year built:</b></label> </center>
			<center><input class="sp" type="year"  name="yr" placeholder="ex: 2002" required></center>
		
			<center>
			<label for="type"><b><p>Choose the property type</p></b></label>
			<select name ="type">
			  <option value="Villa">Villa</option>
			  <option value="Apartment">Apartment</option>
			</select>
			</center>

			<br>
			<center><label for="address"><b>Address</b></label> </center>
			<center><input class="sp" type="addr" name="address" required></center>

			<br>
			<center><label for="price"><b>Price (EGP) [if rent, then /month]</b></label> </center>
			<center><input class="sp" type="number" placeholder="ex. 3,000,000" name="price" required></center>

			<br>
			<center><label for="sqft"><b>SQFT</b></label> </center>
			<center><input class="sp" type="number" placeholder="ex: 350sqft" name="sqft" required></center>

			<br>
			<center><label for="noofbeds"><b>Number of beds</b></label> </center>
			<center><input class="sp" type="number" placeholder="ex: 1 , 2 , 3" name="noofbeds" required></center>

			<br>
			<center><label for="noofbr"><b>Number of bathrooms</b></label> </center>
			<center><input class="sp" type="number" placeholder="ex: 1 , 2 , 3" name="noofbr" required></center>

			<br>
			<center>
			<label for="bs"><b>Choose an option</b></label>
				<select name = "bs">
				  <option value="s">SELL</option>
				  <option value="r">RENT</option>
				</select>
			</center>

			<br><br>
			<center>
			<b>Select image to upload:</b>
			<input type="file" name="fileToUpload">
			<br><br><br>
    		<input type="submit" class="btn2" value="Sell Property" name="add">
			</center>
		</form>

		<center>
		<form action="sell_property.php" method="post">
		<input type="submit" name="cb" class="btn2" value ="Back to branches"/>
		</form>
		</center>


<?php
if(isset($_POST['cb']))
{
	header('location:branches.php');
}
?>

<?php
if(isset($_POST['add']))
{
	$year = $_POST['yr'];
	$type = $_POST['type'];
	$price = $_POST['price'];
	$address=$_POST['address'];
	$sqft=$_POST['sqft'];
	$beds=$_POST['noofbeds'];
	$bathroom=$_POST['noofbr'];
	// $id=$_SESSION['newc'];
	$S_R = $_POST['bs'];
	$email = $_SESSION['user_name'];
	$filename = $_POST["fileToUpload"];
	$img ="photos/".$filename;

	$ar =$_SESSION['area'];
	$query="SELECT BranchNumber FROM Branch WHERE Area='$ar'";
	$query_run=mysqli_query($con,$query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$id = $resultarr["BranchNumber"];

	
	$query="SELECT ClientNumber FROM SignINUP WHERE Email='$email'";
	$query_run=mysqli_query($con,$query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$uid = $resultarr["ClientNumber"];
	$_SESSION['seller'] = $uid;

	$query="SELECT Area FROM Branch WHERE BranchID='$id'";
	$query_run=mysqli_query($con,$query);
	$resultarr = mysqli_fetch_assoc($query_run);
	$place = $resultarr["Area"];

	$query = "INSERT INTO Property (YEAR,Type,Price,SQFT,No_of_beds,No_of_bathrooms,Address, BranchID,S_R,SellerID,img) VALUES ('$year','$type','$price','$sqft','$beds','$bathroom','$address','$id','$S_R', '$uid','$img')";
	$query_run = mysqli_query($con,$query);

	if($query_run)
	{
		echo '<script type="text/javascript"> alert("Your property has been added succesfully to our system") </script';
		header('location:branches.php');

	}
	else
	{
		echo '<script type="text/javascript"> alert("ERROR!") </script';
	}
}
?>



	</div>
</body>

</html>