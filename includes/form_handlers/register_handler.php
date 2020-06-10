<?php 
//Declaring variables to prevent errors\
$fname="";//First name
$lname="";//Last name
$em="";//Email
$em2="";//email 2
$password="";//password
$password2="";//password2
$date="";//Signup date
$error_array= array();//holds error message into array..also syntax for declaring a variable

//now handling the form
if(isset($_POST['register_button'])) {
	
	//register form values
	
	//First Name
	$fname=strip_tags($_POST['reg_fname']); //strip tag is a security tag ..like if any html tags are entered in the value it will remove that ..since it can may change our website; //simply Remove html tags
	$fname=str_replace(' ','',$fname);//str_replace replaces any space ' ' entered with no space '', so this ' ' and '' is parameter and third parameter is the variable name in which action is to be applied //simply remove spaces
	$fname=ucfirst(strtolower($fname));//this changes the first letter to upper case and and rest to lower case..no matter what is entered by the user
	$_SESSION['reg_fname']=$fname;   //session variables which stores first name,,, so that it remains saved if any error occurs and this value is right...without this the whole form data entered by user is set to null;

	//Last name
	$lname=strip_tags($_POST['reg_lname']);  //removes html tags if any
	$lname=str_replace(' ','',$lname); //replaces spaces with no space
	$lname=ucfirst(strtolower($lname)); //uppercase first letter
	$_SESSION['reg_lname']=$lname; //stores last name into session variables

	//email
	$em=strip_tags($_POST['reg_email']);  //removes html tags if any
	$em=str_replace(' ','',$em);  //replaces spaces with no space
	$em=ucfirst(strtolower($em));   //uppercase first letter
	$_SESSION['reg_email']=$em;  //stores email into session variables

	//email2
	$em2=strip_tags($_POST['reg_email2']);   //removes html tags if any
	$em2=str_replace(' ','',$em2);           //replaces spaces with no space  
	$em2=ucfirst(strtolower($em2));     //uppercase first letter
	$_SESSION['reg_email2']=$em2;    //stores email2 in session variables

	//password
	$password=strip_tags($_POST['reg_password']); //we dont want to change the password by removing sapces and changing the letters to uc and lc so we removed the other two function in this one

	//password 2
	$password2=strip_tags($_POST['reg_password2']);
	
	//current date
	$date= date("Y-m-d");  //Y should be kept upper case...this wil simply store  the date of sign up in $date variable;


	//email validation
	if($em == $em2){
		//Check if emails is in valid format
		if(filter_var($em, FILTER_VALIDATE_EMAIL)){
			$em=filter_var($em, FILTER_VALIDATE_EMAIL); //this includes the validated version of email to varible $em

			//check if email already exists and for this we need user table in database to validate email, so go and create one in database.
			$e_check=mysqli_query($con, "SELECT email FROM users WHERE email='$em' "); //if no email found the this query wont return anything else it returns something

			//count the number of rows returned
			$num_rows=mysqli_num_rows($e_check);  //num_rows will now contain number of results produced

			if($num_rows>0){
				array_push($error_array,"Email already in use<br>");
			}

		}
		else{
			array_push($error_array, "Invalid email format<br>");  //we can also echo this message but here we are storing it into an array.. for simply printing this messsage we use--- echo "Invalid email format" 
		}

	}
	else{
		array_push($error_array, "Emails dont match<br>");
	}

	//other validations
	if(strlen($fname) >25 || strlen($fname)<2){
		array_push($error_array,"Your first name must be between 2 and 25 letters<br>");
	}
	if(strlen($lname) >25 || strlen($lname)<2){
		array_push($error_array,"Your Last name must be between 2 and 25 letters<br>");
	}
	//password validation
	if($password != $password2){
		array_push($error_array, "Your password doesnot match<br>");
	}
	else{
		if(preg_match('/[^A-Za-z0-9]/',$password)){     //for password validation i,e it should contain characters and numbers only
			array_push($error_array,"Your password can only contain english character or numbers<br>");
		}
	}

	if(strlen($password)> 30 || strlen($password)<5){
		array_push($error_array,"Your password must be between 5 and 25 characters<br>");
	}

	//storing the values in database
	if(empty($error_array)){  //to check if there is no error in error array then only we will push the data in database.
		$password= md5($password); //Encrypts the password before sending into database so even we can not see password in database also.

		//Generating username by concatenating first name and last name. without letting users know this..it will be done by our side
		$username =strtolower($fname . "_" . $lname); //concatenating with underscore to generate username
		//checking the database if any user is already having same username
		$check_username_query= mysqli_query($con, "SELECT username FROM users WHERE username ='$username'");

		$i=0;
		//if username exists add number to usernames 
		while(mysqli_num_rows($check_username_query) !=0){
			$i++;  // add 1 to i
			$username = $username . "_" . $i; //this will add number at the end of username so no username should be equal in database. and this will be repeated if still there exists any username with same number at end..so this has to be again checked into database and that will return some value  if same username exists and this while loop will continue by updating ythe value of variable i. The username will look like--- siddharth_singh_1.
			$check_username_query= mysqli_query($con, "SELECT username FROM users WHERE username ='$username'"); //if this returns some value that means there is already username present so while loop will run again and increment the value of i and will add it to username and again query will be done..if nothing is returned that means the current username is unique and it will be stored.
		} 
		//default profile picture assignment to user.
		$rand= rand(1,2); //random number between 1 and 2 to select profile picture from folder randomly..we dont want to assign same profile picture to everyone
		if($rand==1)
			$profile_pic= "multimedia/images/display_pic/defaults/devil.png";
		if($rand==2)
			$profile_pic= "multimedia/images/display_pic/defaults/bluehead.png";

		//Putting values into database

		$query=mysqli_query($con, "INSERT INTO users VALUES('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");
		array_push($error_array,"<span style='color: #053240;'> You're all set! Go ahead and login into your account!</span><br>");  //If the query of inserting values in database is successful taht means user has been registered with us so now we have to display message to log in.. so the message is pushed in errror_array as we already have that so we wil use the same array to store this. and from here we need to display this value in form tag under html so go below there after submit button code.

		//Clear session variables..i,e when user is registered succesfully then we have to remove its information from the form which is still being displayed due to the session variables.
		$_SESSION['reg_fname']="";
		$_SESSION['reg_lname']="";
		$_SESSION['reg_email']="";
		$_SESSION['reg_email2']="";
	}
}
?>