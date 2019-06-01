<?php
session_start();
include("db.php");
$pagename="Smart Basket";
 //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
 //Call in stylesheet
echo "<title>".$pagename."</title>";
 //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
include ("detectlogin.php");

if (isset ($_POST['hiddenindex'])){
	$delprodid = $_POST['hiddenindex'];
	unset($_SESSION['basket'][$delprodid]);
	//array_splice($_SESSION['basket'][$delprodid]);
	echo "<p>1 item removed from the basket";
}

if (isset ($_POST['h_prodid'])){

 //capture the ID of selected product using the POST method and the $_POST superglobal variable
$newprodid = $_POST['h_prodid'];
$reququantity = $_POST['p_quantity'];

 //and store it in a new local variable called $newprodid

//capture the required quantity of selected product using the POST method and $_POST superglobal variable
//and store it in a new local variable called $reququantity

//Display id of selected product
//Display quantity of selected product
//echo "id of selected product: " .$newprodid ."<br>";
//echo "Quantity of selected product: " .$reququantity;

//create a new cell in the basket session array. Index this cell with the new product id.
//Inside the cell store the required product quantity
$_SESSION['basket'][$newprodid]=$reququantity;
//echo "<p>The doc id ".$newdocid." has been ".$_SESSION['basket'][$newdocid];

//Create a HTML table with a header to display the content of the shopping basket
//i.e. the product name, the price, the selected quantity and the subtotal
echo "<p>1 item added to the basket.</p>";
}
else {
echo  "<p>Current basket unchanged.</p>"; 
}

echo "<table>";
echo "<tr>";
echo "<th> Product name </th>";
echo "<th> Price </th>";
echo "<th> Selected quantity </th>";
echo "<th> Subtotal </th>";
echo "<th> </th>";
echo "</tr>";

//if the session array $_SESSION['basket'] is set
if (isset ($_SESSION['basket'])) {
//store the id in a local variable $index & store the required quantity into a local variable $value
//$index = $_POST['h_prodid'];
//$value = $_POST['p_quantity'];
$total = 0;
//loop through the basket session array for each data item inside the session using a foreach loop
foreach($_SESSION['basket'] as $index => $value) {
//to split the session array between the index and the content of the cell
//for each iteration of the loop


//SQL query to retrieve from Product table details of selected product for which id matches $index
$SQL="select prodId,prodName, prodPrice from Product where prodid=".$index;
$exeSQL=mysql_query($SQL) or die (mysql_error($conn));
//execute query and create array of records $arrayp
while ($arrayp=mysql_fetch_array($exeSQL)){
//create a new HTML table row
	echo "<tr>";
//display product name using array of records $arrayp
	echo "<td><p>".$arrayp['prodName']."</p></td>";
//display product price using the array of records $arrayp
	echo "<td><p> $".$arrayp['prodPrice']."</p></td>";
//display selected quantity of product retrieved from the cell of session array and now in $value
	echo "<td><p>".$value."</p></td>";
//calculate subtotal, store it in a local variable $subtotal and display it
	$subtotal = $arrayp['prodPrice']*$value;
	$total = $total + $subtotal;
	echo "<td><p><b> $".$subtotal."</b></p></td>";
	echo "<form action=basket.php method=post>";
	echo "<td><input type=submit value='Remove'></td>";
	echo "<input type=hidden name=hiddenindex value=".$index.">";
    echo "</form>";
	echo "</tr>";
}
//increase total by adding the subtotal to the current total
}
// Display total
echo "<tr>";
echo "<td colspan='3' style='margin-left:0px;'><h3>TOTAL</h3></td>";
echo "<td><p><b> $".$total."</b></p></td>";
echo "</tr>";
}else{
	echo"<p>Empty Basket</p><br>";
	echo "<tr>";
	echo "<td colspan='3' style='margin-left:0px;'><h3>TOTAL</h3></td>";
	echo "<td><p><b> $0.00</b></p></td>";
	echo "</tr>";
}
echo "</table><br>";
echo "<a href='clearbasket.php'>CLEAR BASKET</a>";
//if the session user id $_SESSION['userid'] is set (i.e. if the user has logged in successfully)
if (isset($_SESSION['userid']))
{
//display a Checkout anchor to link to checkout.php
echo "<p>To finalise your order: <a href='checkout.php'>Checkout</a></p>";	
}
else
{
//display a Signup anchor for new customers to link to signup.php
//display a Login anchor for returning customers to link to login.php
echo "<p>New hometeq customers: <a href='signup.php'>Sign up</a></p>";
echo "<p>Returning hometeq customers: <a href='login.php'>Login</a></p>";
}

echo "<br>";
//else
//{
//Display empty basket message

//}

include("footfile.html"); 

//include head layout

echo "</body>";
?>