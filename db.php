<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
//$dbname = 'w1673693_nisal';
//create a DB connection
//$conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname) ;
$conn = mysql_connect($dbhost, $dbuser, $dbpass) ;
//if the DB connection fails, display an error message and exit
if (!$conn)
{
 die('Could not connect: ' . mysql_error($conn));
}
//select the database
mysql_select_db("w1673693_nisal",$conn);
?>