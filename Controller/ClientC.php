<?php 
include "../config.php";
class ClientC{

public function afficherClients()
{
    $sql="SELECT * From client";
    $db=config::getConnexion();
    try
      {
       $liste=$db->query($sql);
        return $liste;
      }
    catch(Exception $e)
      {
        die('Erreur:' .$e->getMessage());
      }
}


function recupereremail($email)
{
    $sql="SELECT * from client where email=:email";
    $db = config::getConnexion();
    try
       {
        $req=$db->prepare($sql);
        $req->bindValue(':email',$email);
        $req->execute();
        $res=$req->fetchAll();
        return $res;
        }
    catch (Exception $e)
        {
            die('Erreur: '.$e->getMessage());
        }
}

function ajouterClientToken($email,$token){
  $sql="UPDATE client SET mdp=:token WHERE email=:email";
  $db = config::getConnexion();
  try{
  
  $req=$db->prepare($sql);

  $req->bindValue(':email',$email);
  $req->bindValue(':token',password_hash($token, PASSWORD_DEFAULT));

  
      $req->execute();
     
  }
  catch (Exception $e){
      echo 'Erreur: '.$e->getMessage();
  }
  
}


function recupererClientByEtat($statut)
{
    $sql="SELECT * from client where statut='$statut'";
    $db = config::getConnexion();
    try
       {
        $liste=$db->query($sql);
        return $liste;
       }
    catch (Exception $e)
       {
           die('Erreur: '.$e->getMessage());
       }
    }


function recupererClient($id)
{
    $sql="SELECT * from client where id=:id";
    $db = config::getConnexion();
    try
       {
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        $req->execute();
        $res=$req->fetchAll();
        return $res;
       }
    catch (Exception $e)
       {
           die('Erreur: '.$e->getMessage());
       }
    }


public function ajouterclients($client)
{
    $sql="insert into client(nom,prenom,email,mdp,tel,adresse,sexe,date_nais,role,statut) values(:nom,:prenom,:email,:mdp,:tel,:adresse,:sexe,:date_nais,:role,:statut)";
    $db=config::getConnexion();
    try
      {
       $req=$db->prepare($sql);
       $nom=$client->getNom();
       $prenom=$client->getPrenom();
       $email=$client->getEmail();
       $mdp=password_hash($client->getMdp(), PASSWORD_DEFAULT);
       $tel=$client->getTel();
       $adresse=$client->getAdresse();
       $sexe=$client->getSexe();
       $date_nais=$client->getDateNais();
       $role=$client->getRole();
       $statut=$client->getStatut();
       $req->bindValue(':nom',$nom);
       $req->bindValue(':prenom',$prenom);
       $req->bindValue(':email',$email);
       $req->bindValue(':mdp',$mdp);
       $req->bindValue(':tel',$tel);
       $req->bindValue(':adresse',$adresse);
       $req->bindValue(':sexe',$sexe);
       $req->bindValue(':date_nais',$date_nais);
       $req->bindValue(':role',$role);
       $req->bindValue(':statut',$statut);
       $req->execute();
       }
    catch(Exception $e)
      {
        die('Erreur:' .$e->getMessage());
      }
    
}

function bloquer($id)
{
    $sql="UPDATE client SET statut='Bloquer' WHERE id=:id";
    $db = config::getConnexion();
    try
        {
        $req=$db->prepare($sql);
        $req->bindValue(':id',$id);
        $req->execute();
        }
    catch (Exception $e)
        {
            echo 'Erreur: '.$e->getMessage();
        }
}

function debloquer($id)
{
        $sql="UPDATE client SET statut='Verified' WHERE id=:id";
        $db = config::getConnexion();
        try
            {
            $req=$db->prepare($sql);
            $req->bindValue(':id',$id);
            $req->execute();
            }
        catch (Exception $e)
            {
                echo 'Erreur: '.$e->getMessage();
            }
}
    
        
//chya3mel update lil immage ama fil asel yajouti fil path

function ajouterClientimg($email,$image)
{
    $sql="UPDATE client SET image=:image WHERE email=:email";
    $db = config::getConnexion();
    try
        {
        $req=$db->prepare($sql);
        $req->bindValue(':email',$email);
        $req->bindValue(':image',$image);
        $req->execute();
        }
    catch (Exception $e)
        {
            echo 'Erreur: '.$e->getMessage();
        }
    }


public function supprimerClient($id)
{
    $sql="DELETE FROM client where id=:id";
    $db=config::getConnexion();
    try
      {
      $req=$db->prepare($sql);
      $req->bindValue(':id',$id);
      $req->execute();
      }
    catch(Exception $e)
      {
        die('Erreur:' .$e->getMessage());
      } 
}

function modifierClientPwd($client,$id){
        $sql="UPDATE client SET nom=:nom,prenom=:prenom,email=:email,mdp=:mdp,tel=:tel,adresse=:adresse,sexe=:sexe,date_nais=:date_nais,role=:role,statut=:statut WHERE id=:id";
        
        $db = config::getConnexion();
        //$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        try{        
        $req=$db->prepare($sql);
        $nom=$client->getNom();
        $prenom=$client->getPrenom();
        $email=$client->getEmail();
        $mdp=password_hash($client->getMdp(), PASSWORD_DEFAULT);
        $tel=$client->getTel();
        $adresse=$client->getAdresse();
        $sexe=$client->getSexe();
        $date_nais=$client->getDateNais();
        $role=$client->getRole();
        $statut=$client->getStatut();
 
        $datas = array(':id'=>$id, ':nom'=>$nom, ':prenom'=>$prenom, ':email'=>$email, ':mdp'=>$mdp,':tel'=>$tel);
        $req->bindValue(':id',$id);
        $req->bindValue(':prenom',$prenom);
        $req->bindValue(':nom',$nom);
        $req->bindValue(':email',$email);
        $req->bindValue(':mdp',$mdp);
        $req->bindValue(':tel',$tel);
        $req->bindValue(':adresse',$adresse);
        $req->bindValue(':sexe',$sexe);
        $req->bindValue(':date_nais',$date_nais);
        $req->bindValue(':role',$role);
        $req->bindValue(':statut',$statut);
 
            $s=$req->execute();
            
           // header('Location: index.php');
        }
        catch (Exception $e){
            echo " Erreur ! ".$e->getMessage();
   echo " Les datas : " ;
  print_r($datas);
        }
}


function modifierClient($client,$id)
{
    $sql="UPDATE client SET nom=:nom,prenom=:prenom,email=:email,tel=:tel,adresse=:adresse,sexe=:sexe,date_nais=:date_nais,role=:role,statut=:statut WHERE id=:id";
    $db = config::getConnexion();
        //$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    try{        
        $req=$db->prepare($sql);
        $nom=$client->getNom();
        $prenom=$client->getPrenom();
        $email=$client->getEmail();
        $tel=$client->getTel();
        $adresse=$client->getAdresse();
        $sexe=$client->getSexe();
        $date_nais=$client->getDateNais();
        $role=$client->getRole();
        $statut=$client->getStatut();
 
        $datas = array(':id'=>$id, ':nom'=>$nom, ':prenom'=>$prenom, ':email'=>$email,':tel'=>$tel);
        $req->bindValue(':id',$id);
        $req->bindValue(':nom',$nom);
        $req->bindValue(':prenom',$prenom);
        $req->bindValue(':email',$email);
        $req->bindValue(':tel',$tel);
        $req->bindValue(':adresse',$adresse);
        $req->bindValue(':sexe',$sexe);
        $req->bindValue(':date_nais',$date_nais);
        $req->bindValue(':role',$role);
        $req->bindValue(':statut',$statut);

            $s=$req->execute();
            
           // header('Location: index.php');
    }
    catch (Exception $e)
    {
        echo " Erreur ! ".$e->getMessage();
        echo " Les datas : " ;
        print_r($datas);
        die;
    }
        

}
}
?>
