<?php 
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
unset($_SESSION["client"]);
unset($_SESSION["idclient"]);
unset($_SESSION["clientnom"]);
unset($_SESSION["clientprenom"]);
unset($_SESSION["clientemail"]);
unset($_SESSION["clienttel"]);
unset($_SESSION["clientadresse"]);
unset($_SESSION["clientsexe"]);
unset($_SESSION["clientdate_naiss"]);
unset($_SESSION["clientimage"]);
header("location: SignIn.php");
/*session deleted. if you try using this you've got an error*/
?>