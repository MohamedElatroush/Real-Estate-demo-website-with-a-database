<?php
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>OPMS | Branches</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<div id="wel-des">
<body style = "background-color: #122C60">
<center><h2> Branches </h2></center>
<center><img src="photos/branches.png" width="50"></center>
<br><br>

<center><h3>Welcome, <?php echo $_SESSION['user_name']?></h3></center>

<br><br>

<center><h3>Select a branch</h3> </center>

<center>

<!-- <form action="branches.php" method="post">
<center><input type="submit" name="newcairo" class="btn2" value ="New Cairo - Cairo"/></center>
</form>

<form action="branches.php" method="post">
<center><input type="submit" name="heliopolis" class="btn2" value ="Heliopolis - Cairo"/></center>
</form>

<form action="branches.php" method="post">
<center><input type="submit" name="mohandsin" class="btn2" value ="Mohandsin - Giza"/></center>
</form>

<form action="branches.php" method="post">
<center><input type="submit" name="zamalek" class="btn2" value ="Zamalek"/></center>
</form>

<form action="branches.php" method="post">
<center><input type="submit" name="sz" class="btn2" value ="Sheikh Zayed"/></center>
</form>

<form action="branches.php" method="post">
<center><input type="submit" name="alex" class="btn2" value ="Alexandria"/></center>
</form> -->



		<?php
			$query="SELECT Area FROM Branch";
			$result = $con->query($query);
			while($rows=mysqli_fetch_assoc($result))
				{
					?>
					<tr>
						<form action="branches.php" method="post">
						<td><center><input type="submit" class="btn2" name="<?php echo $rows['Area']; ?>" value ="<?php echo $rows['Area']; ?>"/></center></td>
					</form>
					</tr>
					<?php
				}
				?>


<br><br>

<form action="history.php" method="post">
<center><input type="submit" name="hist" class="btn2" value ="Search Users' history!"/></center>
</form>


<br><br>

<form action="branches.php" method="post">
<input type="submit" name="out" class="btn1" value ="Log Out"/>
</form>


</center>

<?php

	if(isset($_POST['out']))
	{
		session_destroy();
		header('location:index.php');
	}

	// else if(isset($_POST['newcairo']))
	// {
	// $query="SELECT BranchNumber FROM Branch WHERE (Area='New Cairo')";
	// $result = $con->query($query);
	// $resultarr = mysqli_fetch_assoc($result);
	// $attempts = $resultarr["BranchNumber"];
	// $_SESSION['newc'] = $attempts;
	// header('location:newcairo.php');
	// }

	// else if (isset($_POST['heliopolis']))
	// {
	// 	$query="SELECT BranchNumber FROM Branch WHERE (Area='Heliopolis')";
	// 	$result = $con->query($query);
	// 	$resultarr = mysqli_fetch_assoc($result);
	// 	$attempts = $resultarr["BranchNumber"];
	// 	$_SESSION['newc'] = $attempts;
	// 	header('location:Heliopolis.php');
	// }

	// else if(isset($_POST['mohandsin']))
	// {

	// $query="SELECT BranchNumber FROM Branch WHERE (Area='Mohandseen')";
	// $result = $con->query($query);
	// $resultarr = mysqli_fetch_assoc($result);
	// $attempts = $resultarr["BranchNumber"];
	// $_SESSION['newc'] = $attempts;
	// header('location:mohandseen.php');
	// }

	// else if(isset($_POST['zamalek']))
	// {

	// $query="SELECT BranchNumber FROM Branch WHERE (Area='Zamalek')";
	// $result = $con->query($query);
	// $resultarr = mysqli_fetch_assoc($result);
	// $attempts = $resultarr["BranchNumber"];
	// $_SESSION['newc'] = $attempts;
	// header('location:zamalek.php');
	// }

	// else if(isset($_POST['sz']))
	// {

	// $query="SELECT BranchNumber FROM Branch WHERE (Area='Sheikh Zayed')";
	// $result = $con->query($query);
	// $resultarr = mysqli_fetch_assoc($result);
	// $attempts = $resultarr["BranchNumber"];
	// $_SESSION['newc'] = $attempts;
	// header('location:Sheikhzayed.php');
	// }

	// else if(isset($_POST['alex']))
	// {

	// $query="SELECT BranchNumber FROM Branch WHERE (Area='Alexandria')";
	// $result = $con->query($query);
	// $resultarr = mysqli_fetch_assoc($result);
	// $attempts = $resultarr["BranchNumber"];
	// $_SESSION['newc'] = $attempts;
	// header('location:alexandria.php');
	// }


?>

<?php
$query="SELECT Area FROM Branch";
$run = $con->query($query);


while($rows=mysqli_fetch_assoc($run))
	{
		if(isset($_POST[$rows['Area']]))
		{
			$_SESSION['area'] = $rows['Area'];
			header('location:chosenbranch.php');
		}
	}

?>




</body>
</div>

</html>
