<?php
session_start();
include ("db.php"); //include db.php file to connect to DB
$pagename="Make your home smart"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
include ("detectlogin.php");
//create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL="select prodId, prodName, prodPicNameSmall, prodPrice, prodDescripShort from Product";
//run SQL query for connected DB or exit and display error message
$exeSQL=mysql_query($SQL) or die (mysql_error());
echo "<table style='border: 0px'>";
//create an array of records (2 dimensional variable) called $arrayp.
//populate it with the records retrieved by the SQL query previously executed.
//Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp=mysql_fetch_array($exeSQL))
{
echo "<tr>";
echo "<td style='border: 0px'>";
//display the small image whose name is contained in the array
echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId']."><img src=".$arrayp['prodPicNameSmall']." height=200 width=200></a>";
echo "</td>";
echo "<td style='border: 0px'>";
echo "<p><a href=prodinfo.php?u_prodid=".$arrayp['prodId'].">"; echo "</a>";
echo "<p><h5>".$arrayp['prodName']."</h5>"; //display product name as contained in the array

echo "<p>".$arrayp['prodDescripShort']."";
echo "<h3> $".$arrayp['prodPrice']."</h3>";
echo "</td>";
echo "</tr>";
}
echo "</table>";
include ("footfile.html");
echo "</body>";
?>