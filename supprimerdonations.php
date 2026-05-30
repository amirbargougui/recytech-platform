<?PHP
include "../Controller/donorC.php";


$don=new donorC();
if (isset($_POST["id_donation"])){

	$don->supprimerdonations($_POST["id_donation"]);
	header('Location:Afficherdonations.php');
}

?>