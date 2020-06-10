<?php 
if(isset($_POST['login_button'])){

	$email=filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email
	$_SESSION['log_email']=$email;// Store email into session variable
	$password= md5($_POST['log_password']); //get password

	$check_database_query= mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND password='$password'"); //this will check database if user exists with the provided email and password, if yes it will return number of rows.

	$check_login_query=mysqli_num_rows($check_database_query); //this will store result returned by above query
	if($check_login_query==1){
		$row=mysqli_fetch_array($check_database_query);  //this function stores the result of the query check_database_query in an array so that we can use any data of that row using [] same as we access array element in C.
		$username= $row['username'];  //here we are accessing the value of username in the row from array $row.

		//if the account is closed ...we will open that account again with this below code
		$user_closed_query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
		if(mysqli_num_rows($user_closed_query)==1){
			$reopen_account=mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'"); 
		}

		$_SESSION['username']=$username;
		header("Location: index.php"); //This will redirect the page to index.php..i,e the homepage for the user
		exit();
	}
	else{
		array_push($error_array,"Email or password was incorrect<br>");
	}


}

?>