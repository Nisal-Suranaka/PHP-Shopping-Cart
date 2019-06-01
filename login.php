<?php
session_start();
$pagename="Login";
 //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
 //Call in stylesheet
echo "<title>".$pagename."</title>";
 //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

echo "<form method=post action=login_process.php>" ;
echo "<table border=0 cellpadding=10>";
echo "<tr><td>Email </td>";
echo "<td><input type=text name=email size=35></td></tr>";
echo "<tr><td>Password </td>";
echo "<td><input type=password name=password size=35></td></tr>";
echo "<tr><td><input type=submit value='Login'></td>";
echo "<td><input type=reset value='Clear Form'></td></tr>";
echo "</table>";
echo "</form>" ;

include("footfile.html"); 

//include head layout

echo "</body>";
?>