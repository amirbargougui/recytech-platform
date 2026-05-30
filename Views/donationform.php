<?php
session_start();

include_once '../Controller/donorC.php';
include_once '../Model/donor.php';
include_once '../Controller/organisationC.php';

$id = $_GET["id"];

$error = "";
$donor=null;
$donorC= new donorC();
$orgC= new organisationC();
$listeOrg=$orgC->afficherOrganisationWithID($id);
foreach($listeOrg as $rowOrg){
    $nomOrg=$rowOrg['name'];
}
include_once "../Model/Client.php";
include_once "../Controller/ClientC.php";

$idclient =0;
if(isset($_SESSION['idclient']))
{
    $idclient = $_SESSION['idclient'];
}
$clientC = new ClientC();
$result=$clientC->recupererClient( $idclient);
foreach($result as $row){
    $nom=$row['nom'];
    $prenom=$row['prenom'];
    $email=$row['email'];
    $mdp=$row['mdp'];
    $tel=$row['tel'];
    $adresse=$row['adresse'];
    $sexe=$row['sexe'];
    $date_naiss=$row['date_nais'];
    $image=$row['image'];
    }


if(isset($_POST['ajouter']))
{
    if (
    
    
        isset($_POST["Name"]) &&		
        isset($_POST["Email"]) && 
        isset($_POST["Address"]) &&
        isset($_POST["CardName"]) &&
        isset($_POST["CreditCardNum"]) &&
        isset($_POST["BilingAdress"]) &&
        isset($_POST["ZipCode"]) &&
        isset($_POST["Cvv"]) &&
        isset($_POST["ExpMonth"]) &&
        isset($_POST["ExpYear"]) &&
        isset($_POST["Amount"]) 
        
    ) {
        
           
    
            $donor=new donor(
                $_POST["Name"],
                $_POST["Email"],
                $_POST["Amount"],
               $_POST["Address"],
               $_POST["CardName"],
               $_POST["CreditCardNum"],
               $_POST["BilingAdress"],
               $_POST["Cvv"], 
             $_POST["ExpMonth"],		
               $_POST["ExpYear"],
              $_POST["ZipCode"],
              $id
              
          );


         
          $donorC->ajouterdonations($donor);
          header("location: journal/sendmailDonation.php?email=".$_POST["Email"]."&amount=".$_POST["Amount"]."&organisation=".$nomOrg);
      
    }
        else
            $error = "Missing information";
}

 ?>


<!DOCTYPE html>
<html lang="en" class="no-js" >
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RecyTech</title>
 <!-- custom css file link  -->
 <link type="text/css" rel="stylesheet" href="css/donform.css" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  


    </head>

    <body id="top" class="ss-show">
        <div id="preloader" style="display: none;">
            <div id="loader">
            </div>
        </div>

      


<div class="container">


    <form action="#" method="POST" id="form_donation" name="ajout" enctype="multipart/form-data">

        <div class="row">

            <div class="col">

                <h3 class="title">DONATION FORM</h3>

                <?php if(isset($_SESSION['idclient'])){?>
                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" placeholder="Name" name="Name" id="Name" value="<?php echo $nom ?>" >
                    <span id="nameError" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" name="Email" id="Email" placeholder="example@example.com" value="<?php echo $email ?>">
                    <span id="emailError" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name="Address" id="address" placeholder="room - street - locality"  value="<?php echo $adresse ?>">
                    <span id="addError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" name="ZipCode" id="ZipCode"  placeholder="123 456" >
                        <span id="ZCError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>Amount:</span>
                        <input type="number" name="Amount" placeholder="20$" >
                        <span id="AMError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>choose your paiement method</span>
                      
                        <div class="flex"> 

                        <label for="option1">
                            <img src="images/other options.png" alt="card">
                            <input  type="radio" name="options" id="option1" value="option1" onclick="showForm()" >
                            
                        </label>

                        <label for="option2">
                            <img src="images/paypal.png" alt="paypal">
                            <input  type="radio" name="options" id="option2" value="option2" onclick="showForm()">
                            
                        </label>
                    </div>
                 </div>
                 <?php }else{ ?>
                    <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" placeholder="Name" name="Name" id="Name" >
                    <span id="nameError" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" name="Email" id="Email" placeholder="example@example.com" >
                    <span id="emailError" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name="Address" id="address" placeholder="room - street - locality" >
                    <span id="addError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" name="ZipCode" id="ZipCode"  placeholder="123 456" >
                        <span id="ZCError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>Amount:</span>
                        <input type="number" name="Amount" placeholder="20$" >
                        <span id="AMError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>choose your paiement method</span>
                      
                        <div class="flex"> 

                        <label for="option1">
                            <img src="images/other options.png" alt="card">
                            <input  type="radio" name="options" id="option1" value="option1" onclick="showForm()" >
                            
                        </label>

                        <label for="option2">
                            <img src="images/paypal.png" alt="paypal">
                            <input  type="radio" name="options" id="option2" value="option2" onclick="showForm()">
                            
                        </label>
                    </div>
                 </div>

                <?php } ?>

            </div>

            
            

             <div id="formContainer" class="col" >
                <h3 class="title">payment</h3>

             
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" name="CardName" placeholder="mr. " >
                    <span id="NC" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" name="CreditCardNum" id="CreditCardNum" placeholder="1111-2222-3333-4444" >
                    <span id="CN" class="error-message"></span>

                </div>
                <div class="inputBox">
                    <span>Biling Adress:</span>
                    <input type="text" name="BilingAdress" placeholder="Card location account" >
                    <span id="BA" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" name="ExpMonth" id="ExpMonth" placeholder="january" >
                    <span id="expm" class="error-message"></span>

                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" name="ExpYear" id="ExpYear" placeholder="2022" >
                    <span id="expy" class="error-message"></span>

                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="number" name="Cvv" id="CVV" placeholder="1234" >
                    <span id="CVV" class="error-message"></span>

                    </div>
                </div>

            </div>
    
        </div>
         
        <input type="submit" id="ajouter" name="ajouter" value="proceed to checkout" class="submit-btn">

    </form>

</div>    
    

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
 <script src="js/donationform.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>




</body>
</html>
