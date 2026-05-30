<?php 
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
unset($_SESSION["id"]);
unset($_SESSION["login"]);
unset($_SESSION["nom"]);
header("location: signup.php");
/*session deleted. if you try using this you've got an error*/
?>