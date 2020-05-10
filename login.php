<?php 
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>OPMS | Log In</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style = "background-color: #122C60">

<div class="container">
	<div id="wel-des">
		<center><h2>Log In to your account</h2></center>

		<center><img src="photos/login.png" width="50"></center>

		<form action="login.php" method="post">
		<center><label for="user_email"><b>Email</b></label></center>
		<center><input type="text" class="btn3" placeholder="Email" name="user_email" required></center>

		<center><label for="pw"><b>Password</b></label></center>
		<center><input type="password" class="btn3" placeholder="Enter Your password" name="pw" required></center>

		<center><a href="signup.php" style="float: right;">No Account? Create one now</a></center><br><br>
		<center><button type="submit" name="log" class="btn2">Log In</button></center>
		<br>
		</form>
		<form action="index.php">
		<center><button type="submit" class="btn2">Return</button></center>
		<br>
		</form>

	<?php
		if(isset($_POST['log']))
		{

			$useremail = $_POST['user_email'];
			$password = $_POST['pw'];

			$query = "select * from SignINUP WHERE (Email='$useremail' AND Password='$password')";
			$query_run = mysqli_query($con, $query);

			if(mysqli_num_rows($query_run)>0)
			{
				
				$_SESSION['user_name'] = $useremail;
				$query = "select ClientNumber from SignINUP WHERE Email='$useremail'";
				$query_run = mysqli_query($con, $query);
				$resultarr = mysqli_fetch_assoc($query_run);
				$userid = $resultarr["ClientNumber"];

				$_SESSION['ClientN'] = $userid;


				header('location:branches.php');
				echo '<script type="text/javascript"> alert("Log in success") </script';
			}

			else 
			{
				echo '<script type="text/javascript"> alert("Username or Password is incorrect") </script';
			}
				
		}
	?>

</div>

</div>

</body>
</html>
