
<?php 
	
	include_once '../config.php';
	include_once '../Model/donor.php';
	session_start();

	class donation{
		
	// récupere tous les donors
	function getAlldonor() {
		$con = config::getConnexion();
		$requete = 'SELECT * from donations';
		
		try{
			$liste = $con->query($requete);
			return $liste;
			
			}
			catch(Exception $e){
				die('Erreur:' .$e->getMessage());
			}
	}

	// creer une donation
			function createdonor($donor) { 

					$Name=$donor->getName();
					$Email=$donor->getEmail();
					$Amount=$donor->getAmount();
					$Address=$donor->getAddress();
					$CardName=$donor->getCardName();
					$CreditCardNum=$donor->getCreditCardNum();
					$BilingAdress=$donor->getBilingAdress();
					$ZipCode=$donor->getZipCode();
					$Cvv=$donor->getCvv();
					$ExpMonth=$donor->getExpMonth();
					$ExpYear=$donor->getExpYear();

		try {
			$con = config::getConnexion();
			$sql ="INSERT INTO `donations`(`Name`, `Email`, `Amount`, `Address`, `CardName`, `CreditCardNum`, `BilingAdress`, `Cvv`, `ExpMonth`, `ExpYear`, `ZipCode`)
			VALUES ('$Name','$Email','$Amount','$Address','$CardName','$CreditCardNum','$BilingAdress','$Cvv','$ExpMonth','$ExpYear','$ZipCode')";
			$con->exec($sql);
			
		}
	    catch(PDOException $e) { 
	    	echo $sql . "<br>" . $e->getMessage();
	    }
	}

	public function supprimerdonation($id_donation){
		$sql='DELETE FROM `donations` WHERE id_donation=:id_donation';
		$db= config::getConnexion();
		try{
		$req=$db->prepare($sql);
		$req->bindValue(':id_donation',$id_donation);
		$req->execute();
		}
		catch(Exception $e){
			die('Erreur:' .$e->getMessage());
		}
		
	}
}
    ?>