<?php 
require 'configuration/config.php';  //this includes the config.php file which is used to start session and connect php with database. so for repeatedly writing the whole code in every file we simply include that file using require. 
require 'includes/form_handlers/register_handler.php'; //including the register file for registering users;
require 'includes/form_handlers/login_handler.php';  //including the login handler 
?>


<html>
<head>
	<title>Welcome to WeConnect</title>
	<link rel="stylesheet" type="text/css" href="multimedia/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> <!-- to add jquery , get the link from google hosted libraries -->
	<script src="multimedia/javascript/register.js"></script> <!-- Linking javascript file-->
</head>
<body>
	<!-- this below code is used to show the register form if any errors occured as without this code on clicking register if any error occurs it will still take back to login form so.-->
	<?php 
		if(isset($_POST['register_button'])){  //if user makes any error while filling register form and clicks submit
			echo '
			<script> 
				$(document).ready(function(){  
					$("#first").hide();
					$("#second").show();
				});
			</script>

			'; //it will hide login form which intends to open on clicking submit and will show the errors on register form,
		}


	 ?>

	<div class="wrapper">
		
		<div class="login_box">
			<div class="login_header">
			<h1>WeConnect</h1>
			Login or sign up below	
			</div>
			<div id="first">
				<!--LOGIN FORM-->
				<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="Email Address" value="<?php 
					if(isset($_SESSION['log_email'])){   //this is for displaying the session variables on page.
						echo $_SESSION['log_email'];
					}
					?>"required>
					<br>
					<input type="password" name="log_password" placeholder="Password" required>
					<br>
					<?php if(in_array("Email or password was incorrect<br>",$error_array)) echo "Email or password was incorrect<br>";?>
					<input type="submit" name="login_button" value="Login">
					<br>
					<a href="#" id="signup" class="signup" >Need an account? Register here!</a> <!--The # is link to the same page-->
					
				</form>
			</div>
			
			<div id="second">
				<!-- REGISTER FORM OR SIGNUP FORM -->
				<form action="register.php" method="post"> 

					<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
					if(isset($_SESSION['reg_fname'])){   //this is for displaying the session variables on page.
						echo $_SESSION['reg_fname'];
					}
					?>" required>	
					<br>
					<?php if(in_array("Your first name must be between 2 and 25 letters<br>",$error_array)) echo "Your first name must be between 2 and 25 letters<br>"; ?>


					<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 
					if(isset($_SESSION['reg_lname'])){
						echo $_SESSION['reg_lname'];
					}
					?>" required>
					<br>
					<?php if(in_array("Your Last name must be between 2 and 25 letters<br>",$error_array)) echo "Your Last name must be between 2 and 25 letters<br>"; ?>


					<input type="email" name="reg_email" placeholder="Email" value="<?php 
					if(isset($_SESSION['reg_email'])){
						echo $_SESSION['reg_email']; 
					}
					?>" required>	
					<br>

					<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
					if(isset($_SESSION['reg_email2'])){
						echo $_SESSION['reg_email2'];
					}
					?>" required>
					<br>
					<?php if(in_array("Email already in use<br>",$error_array)) echo "Email already in use<br>";
						else if(in_array("Invalid email format<br>",$error_array)) echo "Invalid email format<br>";
						else if(in_array("Emails dont match<br>",$error_array)) echo "Emails dont match<br>"; ?>


					<input type="password" name="reg_password" placeholder="Password" required>	
					<br>
					<input type="password" name="reg_password2" placeholder="Confirm Password" required>
					<br>
					<?php if(in_array("Your password doesnot match<br>",$error_array)) echo "Your password doesnot match<br>";
						else if(in_array("Your password can only contain english character or numbers<br>",$error_array)) echo "Your password can only contain english character or numbers<br>";
						else if(in_array("Your password must be between 5 and 25 characters<br>",$error_array)) echo "Your password must be between 5 and 25 characters<br>"; ?>

					<input type="submit" name="register_button" value="Register">
					<br> 
					<?php if(in_array("<span style='color: #053240;'> You're all set! Go ahead and login into your account!</span><br>",$error_array)) echo "<span style='color: #053240;'> You're all set! Go ahead and login into your account!</span><br>"; ?>
					<a href="#" id="signin" class="signin" >Already have an account ? Sign in here !</a>
				</form>		
			</div>
			
		</div>
	</div>

</body>
</html>