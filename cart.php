<?php
 session_start();
 echo"welcome ".$_SESSION["uname"];
 echo"<a href='payment.php'>Payment Gateway</a>";

?>