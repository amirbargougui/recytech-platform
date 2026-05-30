<?php
include_once '../config.php';
include_once '../Model/donor.php';


class donorC {

    function afficherorganisation(){
        $sql="SELECT * FROM organisation";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:'. $e->getMessage());
        }
    }

    function rechercherDonation($str){
        $sql="select * from donations where Id_donation like '%".$str."%' or Name like '%".$str."%' or Email like '%".$str."%' or Address like '%".$str."%' or Amount like '%".$str."%' ";
        $db = config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }


    function afficherdonations(){
        $sql="SELECT * FROM donations";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:'. $e->getMessage());
        }
    }

    function recupererOrganisationByDonation($id_organisation){
        $sql="SELECT * from donations where id_organisation='$id_organisation'";
        $db = config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    
    function ajouterdonations($donor){
        
        $sql="INSERT INTO donations (Name,Email,Amount,Address,CardName,CreditCardNum,BilingAdress,Cvv,ExpMonth,ExpYear,ZipCode,id_organisation)
                                VALUES (:Name,:Email,:Amount,:Address,:CardName,:CreditCardNum,:BilingAdress,:Cvv,:ExpMonth,:ExpYear,:ZipCode,:id_organisation)";
       
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                
                'Name'=>$donor->getName(),
                'Email'=>$donor->getEmail(),
                'Amount'=>$donor->getAmount(),
                'Address'=>$donor->getAddress(),
                'CardName'=>$donor->getCardName(),
                'CreditCardNum'=>$donor->getCreditCardNum(),
                'BilingAdress'=>$donor->getBilingAdress(),
                'ZipCode'=>$donor->getZipCode(),
                'Cvv'=>$donor->getCvv(),
                'ExpMonth'=>$donor->getExpMonth(),
                'ExpYear'=>$donor->getExpYear(),
                'id_organisation'=>$donor->getid_organisation()
                
            ]);			
        }
        catch (Exception $e){
            echo 'Erreur: '.$e->getMessage();
        }			
    }

    function recupererdonations($id_donation){
        $sql="SELECT * from donations where id_donation=$id_donation";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $donations=$query->fetch();
            return $donations;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }

    function modifierdonations($donations, $id_donation){
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE donations SET 
                Name= :Name,
                Email= :Email,
                Amount= :Amount,
                Address= :Address,
                CardName =:CardName,
                CreditCardNum =:CreditCardNum,
                BilingAdress =:BilingAdress,
                Cvv =:Cvv,
                ExpMonth =:ExpMonth,
                ExpYear =:ExpYear,
                ZipCode =:ZipCode,
                id_organisation= :id_organisation
                WHERE id_donation= :id_donation'
                    
                
            );
            $query->execute([
                'Name'=>$donor->getName(),
                'Email'=>$donor->getEmail(),
                'Amount'=>$donor->getAmount(),
                'Address'=>$donor->getAddress(),
                'CardName'=>$donor->getCardName(),
                'CreditCardNum'=>$donor->getCreditCardNum(),
                'BilingAdress'=>$donor->getBilingAdress(),
                'ZipCode'=>$donor->getZipCode(),
                'Cvv'=>$donor->getCvv(),
                'ExpMonth'=>$donor->getExpMonth(),
                'ExpYear'=>$donor->getExpYear(),
                'id_organisation'=>$donor->getid_organisation()
                
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function supprimerdonations($id_donation){
        $sql="DELETE FROM donations WHERE id_donation=:id_donation";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id_donation', $id_donation);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}

    }
}

?>