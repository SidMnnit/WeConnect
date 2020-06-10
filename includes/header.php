<?php
require 'configuration/config.php'; //config.php is called here to connect php with database;
if(isset($_SESSION['username'])){
	$userLoggedIn=$_SESSION['username'];  //if this session variable is set make the user login variable equal to that.
	$user_details_query=mysqli_query($con,"SELECT * FROM users WHERE username ='$userLoggedIn'");
	$user=mysqli_fetch_array($user_details_query);
}
else{
	header("Location: register.php"); //if not set send it to log in;
}
?>
<html>
<head>
	<title>WeConnect</title>

	<!--Javascript links-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="multimedia/javascript/bootstrap.js"></script>

	<!--Bootsrap css links-->
	<script src="https://kit.fontawesome.com/f43c44a972.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="multimedia/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="multimedia/css/style.css">
</head>
<body>
	<div class="top_bar">
		<div class="logo">
			&nbsp
			<a href="index.php">WeConnect</a>
		</div>
		<nav>
			<a href="<?php echo $userLoggedIn; ?>">
				<?php 
					echo $user['first_name'];
				?>
			</a>
			<a href="index.php">
				&nbsp
				<i class="fa fa-house-user fa-lg"></i>
			</a>
			<a href="#">
				&nbsp
				<i class="fas fa-envelope fa-lg"></i>
			</a>
			<a href="#">
				&nbsp
				<i class="fas fa-bell fa-lg"></i>
			</a>
			<a href="#">
				&nbsp
				<i class="fas fa-users fa-lg"></i>
			</a>
			<a href="#">
				&nbsp
				<i class="fas fa-cog fa-lg"></i>
			</a>
			<a href="includes/handlers/logout.php">
				&nbsp
				<i class="fas fa-sign-out-alt fa-lg"></i>
				&nbsp&nbsp
			</a>
		</nav>
	</div>

	<div class="wrapper">


