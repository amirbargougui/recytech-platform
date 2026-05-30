<?PHP
include "../Controller/ClientC.php";


$clientC=new ClientC();
if (isset($_GET["id"])){

	$clientC->bloquer($_GET["id"]);
	header('Location: AfficherUsers.php');
}

?>