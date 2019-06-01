<?php
//if the session user id $_SESSION['userid'] is set (i.e. if the user has logged in successfully)
if (isset($_SESSION['userid']))
{
//display first name and surname on the right hand-side, right under the navigation bar
echo "<p>".$_SESSION['fname']." ".$_SESSION['sname']." | " .$_SESSION['user_type'].  " No: ".$_SESSION['userid'];
}
?>