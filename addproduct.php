<?php
session_start();
$pagename="Add a New Product";
 //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
 //Call in stylesheet
echo "<title>".$pagename."</title>";
 //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page


//html form to get user input
echo "<form method=post action=addproduct_conf.php>" ;
echo "<table border=0 cellpadding=10>";
echo "<tr><td>*Product Name </td>";
echo "<td><input type=text name=pname size=35></td></tr>";
echo "<tr><td>*Small Picture Name </td>";
echo "<td><input type=text name=spname size=35></td></tr>";
echo "<tr><td>*Large Picture Name </td>";
echo "<td><input type=text name=lpname size=35></td></tr>";
echo "<tr><td>*Short Description </td>";
echo "<td><input type=text name=sdescrip size=35></td></tr>";
echo "<tr><td>*Long Description  </td>";
echo "<td><input type=text name=ldescrip size=35></td></tr>";
echo "<tr><td>*Price  </td>";
echo "<td><input type=text name=price size=5></td></tr>";
echo "<tr><td>*Initial Stock Quantity  </td>";
echo "<td><input type=text name=qty size=5></td></tr>";
echo "<tr><td><input type=submit value='Add Product'></td>";
echo "<td><input type=reset value='Clear Form'></td></tr>";
echo "</table>";
echo "</form>" ;


include("footfile.html"); 

//include head layout

echo "</body>";
?>