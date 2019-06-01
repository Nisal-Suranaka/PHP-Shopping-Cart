<?php
session_start();
include("db.php");
$pagename="Your Sign Up Results";
 //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
 //Call in stylesheet
echo "<title>".$pagename."</title>";
 //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//Capture the 7 inputs entered in the the 7 fields of the form using the $_POST superglobal variable
$fname= $_POST["fname"];
$lname= $_POST["lname"];
$address= $_POST["address"];
$postcode= $_POST['postcode'];
$telno= $_POST['telno'];
$email= $_POST["email"];
$password= md5($_POST["password"]);
$confirmpassword= md5($_POST["confirmpassword"]);
$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
//	
////if the mandatory fields are empty
//if (empty($fname) or empty($lname) or empty($address) or empty($postcode) or empty($telno) or empty($email) or empty($password) or empty($confirmpassword) )
//{
//	echo "<p><b> Sign-up failed!</b>";
//	echo "<p>Your signup form is incomplete and all fields are mandatory<br>";
//	echo "Make sure you provide all the required details</p>";
//	echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
//}
////if the 2 entered passwords do not match
//if($password != $confirmpassword)
//{
//	echo "<p><b> Sign-up failed!</b></p>";
//	echo"<p>The 2 passwords are not matching<br>";
//	echo"Make sure you enter them correctly</p>";
//	echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
//}
////if email matches the regular expression 
//if(preg_match ($regex, $email)==0)
//{
//	//Display "email not in the right format" message and link back to register page
//	echo "<p><b> Sign-up failed!</b></p>";
//	echo "<p>Email not valid<br>";
//	echo "Make sure you enter a correct email address</p>";
//	echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
//}
//
//else
//{
//	//Write SQL query to insert a new user into users table and execute SQL query
//		$addSQL=
//		"insert into 
//		users ( userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword)
//		values ('C','".$fname."','".$lname."', '".$address."', '".$postcode."','".$telno."','".$email."','".$password."')";
//		
//	//run SQL query
//	$exeaddSQL=mysql_query($addSQL);
//	
//	
//	//Return the SQL execution error number using the error detector (hint: use mysql_errno)
//	//If the error detector returns the number 0, everything is fine
//	if (mysql_errno($conn)==0)
//	{ 
//			//Display registration confirmation message
//		    echo "<p><b> Sign-up successful!</b></p>";
//		    //Display a link to login page
//	        echo"<p>To continue, please<a href='login.php'> login</a>";
//	}
//	//else check individual error codes and display appropriate message
//	else
//	{		
//		  //Display generic error message
//		 //if error detector returned number 1062 i.e. unique constraint on the email is breached
//		//(meaning that the user entered an email which already existed)
//		if (mysql_errno($conn)==1062)
//		{
//			//Display email already taken error message & isplay a link back to signup page
//			echo "<p><b> Sign-up failed!</b></p>";
//	        echo "<p>Email already in use<br>";
//	        echo "You may be already registered or try another email address</p>";
//	        echo"<p>Go Back to<a href='login.php'> Sign_Up</a>";		
//		}
//		
//		//if error detector returned number 1064 i.e. invalid characters such as ' and \ have been entered
//		if(mysql_errno($conn)==1064)
//        {
//	      	//Display invalid characters error message & display a link back to signup page
//			echo "<p><b> Sign-up failed!</b></p>";
//	        echo "<p>Invalid characters entered inthe form<br>";
//	        echo "Make sure tou avoid the following characters: apostrophes lik ['] and backslashes like [\]</p>";
//	        echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
//        }
//	}
//}


//if the mandatory fields are not empty (hint: use the empty function)
if (!empty($fname) and !empty($lname) and !empty($address) and !empty($postcode) and !empty($telno) and !empty($email) and !empty($password) and !empty($confirmpassword))
{
	//if the 2 entered passwords do not match
	if($password != $confirmpassword)
	{
		//Display error passwords not matching message
		//Display a link back to register page
	echo "<p><b> Sign-up failed!</b></p>";
	echo"<p>The 2 passwords are not matching<br>";
	echo"Make sure you enter them correctly</p>";
	echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
	}
	else
	{
		//define regular expression
		//if email matches the regular expression (hint: use preg_match)
		if(preg_match ($regex, $email)!=0)
		{
			//Write SQL query to insert a new user into users table and execute SQL query
			$addSQL=
		"insert into 
		users ( userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword)
		values ('A','".$fname."','".$lname."', '".$address."', '".$postcode."','".$telno."','".$email."','".$password."')";
			//Execute INSERT INTO SQL query
			$exeaddSQL=mysql_query($addSQL);
			
			//Return the SQL execution error number using the error detector (hint: use mysql_errno)
			//If the error detector returns the number 0, everything is fine
			if (mysql_errno($conn)==0)
			{
				//Display registration confirmation message
				//Display a link to login page
					    echo "<p><b> Sign-up successful!</b></p>";
     					echo"<p>To continue, please<a href='login.php'> login</a>";
			}
		else
				//if the error detector does not return the number 0, there is a problem
				{
					//Display generic error message
					//if error detector returned number 1062 i.e. unique constraint on the email is breached
					//(meaning that the user entered an email which already existed)
					if (mysql_errno($conn)==1062)
					{
						//Display email already taken error message & isplay a link back to signup page
							echo "<p><b> Sign-up failed!</b></p>";
	        				echo "<p>Email already in use<br>";
	        				echo "You may be already registered or try another email address</p>";
	        				echo"<p>Go Back to<a href='login.php'> Sign_Up</a>";	
					}
					//if error detector returned number 1064 i.e. invalid characters such as ' and \ have been entered
                    if(mysql_errno($conn)==1064)
					{
						//Display invalid characters error message & display a link back to signup page
							echo "<p><b> Sign-up failed!</b></p>";
       						echo "<p>Invalid characters entered in the form<br>";
	        				echo "Make sure tou avoid the following characters: apostrophes like ['] and backslashes like [\]</p>";
							echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
					}
				}
			}
			else
			{
				//Display "email not in the right format" message and link back to register page
				echo "<p><b> Sign-up failed!</b></p>";
	echo "<p>Email not valid<br>";
	echo "Make sure you enter a correct email address</p>";
	echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
			}
		}
	}
else
{
//Display "all mandatory fields need to be filled in " message and link to register page
	echo "<p><b> Sign-up failed!</b>";
	echo "<p>Your signup form is incomplete and all fields are mandatory<br>";
	echo "Make sure you provide all the required details</p>";
	echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
}
include("footfile.html"); 

//include head layout

echo "</body>";
?>