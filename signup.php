<?php
session_start();
$pagename="Sign Up";
 //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
 //Call in stylesheet
echo "<title>".$pagename."</title>";
 //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page


//html form to get user input
echo "<form method=post action=signup_process.php>" ;
echo "<table border=0 cellpadding=10>";
echo "<tr><td>*First Name </td>";
echo "<td><input type=text name=fname size=35></td></tr>";
echo "<tr><td>*Last Name </td>";
echo "<td><input type=text name=lname size=35></td></tr>";
echo "<tr><td>*Address </td>";
echo "<td><input type=text name=address size=35></td></tr>";
echo "<tr><td>*Postcode </td>";
echo "<td><input type=text name=postcode size=35></td></tr>";
echo "<tr><td>*Tel No  </td>";
echo "<td><input type=text name=telno size=35></td></tr>";
echo "<tr><td>*Email Address  </td>";
echo "<td><input type=text name=email size=35></td></tr>";
echo "<tr><td>*Password  </td>";
echo "<td><input type=text name=password size=35></td></tr>";
echo "<tr><td>*Confirm Password  </td>";
echo "<td><input type=text name=confirmpassword size=35></td></tr>";
echo "<tr><td><input type=submit value='Sign Up'></td>";
echo "<td><input type=reset value='Clear Form'></td></tr>";
echo "</table>";
echo "</form>" ;


include("footfile.html"); 

//include head layout

echo "</body>";
?>