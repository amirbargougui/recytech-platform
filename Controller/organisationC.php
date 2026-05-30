<?php

include_once '../config.php';
include_once '../Model/organisation.php';

class organisationC{
//affichage
    function afficherorganisation(){
        $sql="SELECT * FROM organisation "; 
        $db = config::getConnexion();
       
        try{
            $query=$db->prepare($sql);
            $query->execute();
            

            $liste = $db->query($sql);

            return $liste;  
        }
        catch(Exception $e){
            die('Erreur:'. $e->getMessage());
        }
    }

    
    function afficherOrganisationWithID($id_organisation){
        $sql="SELECT * from organisation where id='$id_organisation'";
        $db = config::getConnexion();
        try{
            $liste=$db->query($sql);
            return $liste;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    
    //ajouter
    function ajouterorganisation($organisation){
          $sql = "INSERT INTO organisation (name, details, adress,image) VALUES (:name, :details, :adress_post,:image)";
        //
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'name' => $organisation->getname(),
                'details' => $organisation->getdetails(),
                'adress_post' => $organisation->getadress(),
                'image' => $organisation->getimage()
                
            ]);			
        } catch (Exception $e) {
            echo 'Erreur: '.$e->getMessage();
        }			
    }

    function recupererorganisation($Id){
        $sql="SELECT * from organisation where id=$Id";
        $db = config::getConnexion();
        try{
            $query=$db->prepare($sql);
            $query->execute();

            $organisation=$query->fetch();
            return $organisation;
        }
        catch (Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
    //modifier
    function modifierorganisation($organisation, $Id){
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE organisation SET 
                    name= :name, 
                    details= :details,
                    adress= :adress_post,
                    image= :image
                    WHERE id= :id'
            );
            $query->execute([
                'id' => $Id,
                'name' => $organisation->getname(),
                'details' => $organisation->getdetails(),
                'adress_post' => $organisation->getadress(),
                'image' => $organisation->getimage(),
                
                
                
            ]);
            echo $query->rowCount() . " records UPadressD successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    function supprimerorganisation($Id){
        $sql="DELETE FROM organisation WHERE id=:Id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':Id', $Id);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}

    }

}