<?php
ini_set("smtp_port","25");
session_start();
include("db.php");
$pagename="Order Confirmation";
 //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
 //Call in stylesheet
echo "<title>".$pagename."</title>";
 //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

//store the current date and time in a local variable $currentdatetime
//use the date PHP function with the 'Y-m-d H:i:s' parameters to make it compatible with the MySQL format.
$currentdatetime =date('Y-m-d H:i:s');
$id = $_SESSION['userid'];
//echo $currentdatetime;
//echo "Id ".$id;
//write a SQL query to insert a new record in the Orders table to generate a new order.
//store the id of the user who is placing the order $_SESSION ['userId']and the current date and time
$addSQL=
"insert into 
orders (orderNo, userid, orderDateTime, orderTotal)
values ('','".$id."','".$currentdatetime."','')";
//Run the SQL query.
$exeadd=mysql_query($addSQL);

//if no database error is returned and the database error code is 0 i.e. if the new order was inserted correctly
if (mysql_errno($conn)==0)
{
//SQL SELECT query to retrieve max order number for current user (for which id matches the id in the session)
$max = "select max(orderNo) from orders where userId='$id'";
//$selSQL="select * from users where userEmail='$email'";
//to retrieve the order number of most recent order placed by current user
$order = "select * from orders where userId='$id'";
//execute SQL query
$exeaddSQL = mysql_query($order);
//fetch the result of the execution of the SQL statement and store it in an array arrayord
$arrayord = mysql_fetch_array($exeaddSQL);
//store the value of this order number in a local variable
$orderNo = $arrayord['orderNo'];
//display message to confirm that order has been placed successfully and display the order number.
echo "<p><b>Succesful order</b> - ORDER REFERENCE NO:  ".$orderNo."</p><br>";
//as for basket.php, display a table header for product name, price, quantity and subtotal
echo "<table>";
echo "<tr>";
echo "<th> Product name </th>";
echo "<th> Price </th>";
echo "<th> Quantity </th>";
echo "<th> Subtotal </th>";
echo "</tr>";
$total = 0;
$empt="";
	$empt .= sprintf("
	<table border='1'>
	<tr>
	<th>Product Name</th>
	<th>Product Price</th>
	<th>Quantity</th>
	<th>Subtotal</th>
	</tr>
	");
//as for basket.php, FOREACH loop through basket session array & split value from index for every cell
foreach($_SESSION['basket'] as $index => $value)
{
//SQL query to retrieve product id, name and price from product table for every index in FOREACH loop
$SQL="select prodId,prodName, prodPrice from Product where prodid=".$index;
//execute SQL query, fetch the records and store them in an array of records $arrayb.
$exeSQL=mysql_query($SQL) or die (mysql_error($conn));
 //$arrayb = mysql_fetch_array($exeSQL);	
//Calculate subtotal
//Note: these 3 instructions are the same as in basket.php
//SQL INSERT query to store details of ordered items in Order_line table in the DB i.e. order number,
//product id (index), ordered quantity (content of the session array) and subtotal. Execute query.
//display the product name, price, ordered quantity and subtotal (same as for basket.php)
//increment total (same as for basket.php)
	
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
	echo "</tr>";
	$insert="insert into order_line
	(orderLineId,orderNo,prodid,quantityOrdered,subTotal)
	values ('','$orderNo','$index','$value','$subtotal')";
	$exeinsertSQL=mysql_query($insert);
	
	//$empt .= sprintf("%s\n - %s\n",$arrayp['prodName'],$value);
	//$empt .= sprintf("%s - %s<br />",$arrayp['prodName'],$value);
	$empt .= sprintf("
	<tr>
	<td>%s</td>
	<td>$%s</td>
	<td>%s</td>
	<td>$%s</td>
	</tr>
	",$arrayp['prodName'],$arrayp['prodPrice'],$value,$subtotal);
	}
	

}
//create a new table row to display the total (same as for basket.php)
	echo "<tr>";
	echo "<td colspan='3'><b>TOTAL</b></td>";
	echo "<td><p><b> $".$total."</b></p></td>";
	echo "</tr>";

	$empt .= sprintf("<tr><td colspan ='3'><b>TOTAL</b></td><td>$%s</td></tr></table>",$total);
//SQL UPDATE query to update the total value in the order table for this specific order
	$update ="update orders set orderTotal='$total' where userId='$id'";
//execute SQL query and display logout link.
	mysql_query($update);
	echo "</table>";
	echo "<br>";
	echo "<p>To log out and leave the system <a href='logout.php'>Logout</a></p>";
	echo "<br>";
}
//else i.e. if a database error is returned, display an order error message
{
//Display an error message that indicates that there has been an error with placing the order
}
//Unset the basket session array
//unset($_SESSION['basket']);

//$to = "nisal444@gmail.com";
//$subject = "My subject";
//$txt = "Hello world!";
//$headers = "From: webmaster@example.com" . "\r\n" .
//"CC: nisal.2017166@iit.ac.lk";
//
//mail($to,$subject,$txt,$headers);
$email = "select userEmail  from users where userId='$id'";
$exeemailSQL = mysql_query($email);
$array = mysql_fetch_array($exeemailSQL);
$userEmail = $array['userEmail'];
echo $userEmail;

$to = $userEmail;
$subject = "HOMETEQ ORDER REFERENCE NO: ".$orderNo;

//$message = "
//<html>
//<head>
//<title>HTML email</title>
//</head>
//<body>
//<p>This email contains HTML Tags!</p>
//<p>ID IS: $id</p>
//<table border='1'>
//<tr>
//<th> Product name </th>
//<th> Price </th>
//<th> Quantity </th>
//<th> Subtotal </th>
//</tr>
//</body>
//</html>
//";

//$message = "<html>
//<head>
//</head>
//<body>
//
//while ($arrayp=mysql_fetch_array($exeSQL)){
//
//}
//
//</body>
//</html>";
//$empty ="";
//while ($arrayp=mysql_fetch_array($exeSQL)){
//	echo $arrayp['prodName'];
//}

echo $empt;

//$message = <<<EOT 
//${empt} 
//EOT;

$message = <<<EOT
Hi ! {$_SESSION['fname']} {$_SESSION['sname']}<br>
${empt}
EOT;




// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <nisal444@gmail.com>' . "\r\n";
$headers .= 'Cc: nisal.2017166@iit.ac.lk' . "\r\n";

mail($to,$subject,$message,$headers);

include("footfile.html"); 

//include head layout

echo "</body>";
?>