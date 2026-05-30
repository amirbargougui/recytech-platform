<?php
	include_once '../Controller/organisationC.php';
	$organisationC=new organisationC();
	$organisationC->supprimerorganisation($_POST["id"]);
	header('Location:afficherorganisation.php');
?>