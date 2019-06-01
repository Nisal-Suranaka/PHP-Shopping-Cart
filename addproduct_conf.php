<?php
session_start();
include("db.php");
$pagename="New Product Confirmation";
 //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
 //Call in stylesheet
echo "<title>".$pagename."</title>";
 //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
include ("detectlogin.php");

//Capture the 7 inputs entered in the the 7 fields of the form using the $_POST superglobal variable
$pname= $_POST["pname"];
$spname= $_POST["spname"];
$lpname= $_POST["lpname"];
$sdescrip= $_POST['sdescrip'];
$ldescrip= $_POST['ldescrip'];
$price= $_POST["price"];
$qty= $_POST["qty"];

//if the mandatory fields are not empty (hint: use the empty function)
if (!empty($pname) and !empty($spname) and !empty($lpname) and !empty($sdescrip) and !empty($ldescrip) and !empty($price) and !empty($qty))
{
//	//if the 2 entered passwords do not match
//	if($password != $confirmpassword)
//	{
//		//Display error passwords not matching message
//		//Display a link back to register page
//	echo "<p><b> Sign-up failed!</b></p>";
//	echo"<p>The 2 passwords are not matching<br>";
//	echo"Make sure you enter them correctly</p>";
//	echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
//	}
//	else
//	{
//		//define regular expression
//		//if email matches the regular expression (hint: use preg_match)
//		if(preg_match ($regex, $email)!=0)
//		{
			//Write SQL query to insert a new user into users table and execute SQL query
			$addSQL= "INSERT INTO Product VALUES ('','$pname','$spname','$lpname','$sdescrip','$ldescrip','$price','$qty')";
			//Execute INSERT INTO SQL query
			$exeaddSQL=mysql_query($addSQL);
			
			//Return the SQL execution error number using the error detector (hint: use mysql_errno)
			//If the error detector returns the number 0, everything is fine
			if (mysql_errno($conn)==0)
			{
				//Display registration confirmation message
				//Display a link to login page
					    echo "<p><b> Product has been added.</b></p>";
						echo "<p>Product Name: ".$pname;
						echo "<p>Small Picture Name: ".$spname;
						echo "<p>Large Picture Name: ".$lpname;
						echo "<p>Short Description: ".$sdescrip;
						echo "<p>Long Description: ".$spname;
						echo "<p>Price: $".$price;
						echo "<p>Quantity: ".$qty;
     					echo"<p>Go Back to<a href='addproduct.php'> Add_Product</a>";
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
							echo "<p><b> Failed!</b></p>";
	        				echo "<p>Product Name already in use<br>";
	        				echo "You may be already added or try another Product Name</p>";
	        				echo"<p>Go Back to<a href='addproduct.php'> Add_Product</a>";	
					}
					//if error detector returned number 1064 i.e. invalid characters such as ' and \ have been entered
                    if(mysql_errno($conn)==1064)
					{
						//Display invalid characters error message & display a link back to signup page
							echo "<p><b> Sign-up failed!</b></p>";
       						echo "<p>Invalid characters entered in the form<br>";
	        				echo "Make sure tou avoid the following characters: apostrophes like ['] and backslashes like [\]</p>";
							echo"<p>Go Back to<a href='addproduct.php'> Add_Product</a>";
					}
					if(mysql_errno($conn)==1054)
					{
						//Display invalid characters error message & display a link back to signup page
							echo "<p><b> Sign-up failed!</b></p>";
       						echo "<p>Invalid characters entered in the form<br>";
	        				echo "illegal characters have been entered in the fields that are expecting numerical values.</p>";
							echo"<p>Go Back to<a href='addproduct.php'> Add_Product</a>";
					}
				}
			}
//			else
//			{
//				//Display "email not in the right format" message and link back to register page
//				echo "<p><b> Sign-up failed!</b></p>";
//	echo "<p>Email not valid<br>";
//	echo "Make sure you enter a correct email address</p>";
//	echo"<p>Go Back to<a href='signup.php'> Sign_Up</a>";
//			}
		//}
	//}
else
{
//Display "all mandatory fields need to be filled in " message and link to register page
	echo "<p><b> Failed!</b>";
	echo "<p>Your add product form is incomplete and all fields are mandatory<br>";
	echo "Make sure you provide all the required details</p>";
	echo"<p>Go Back to<a href='addproduct.php'> Add_Product</a>";
}
include("footfile.html"); 

//include head layout

echo "</body>";
?>