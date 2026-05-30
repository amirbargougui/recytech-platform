<?php

include_once '../Controller/donorC.php';
include_once '../Model/donor.php';

$error = "";
$donor=null;
$donorC= new donorC();

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
    if (
        
        !empty($_POST["Name"]) && 
        !empty($_POST["Email"]) &&
        !empty($_POST["Address"]) &&
        !empty($_POST["CardName"]) &&
        !empty($_POST["CreditCardNum"]) &&
        !empty($_POST["BilingAdress"]) &&
        !empty($_POST["ZipCode"]) &&
        !empty($_POST["Cvv"]) &&
        !empty( $_POST["ExpMonth"]) &&
        !empty($_POST["ExpYear"]) &&
        !empty($_POST["Amount"]) 
     
        
        
    ) {
       

        $donor=new donor(
            $_POST["Name"],
            $_POST["Email"],
           $_POST["Address"],
           $_POST["CardName"],
           $_POST["CreditCardNum"],
           $_POST["BilingAdress"],	
          $_POST["ZipCode"],
           $_POST["Cvv"], 
         $_POST["ExpMonth"],		
           $_POST["ExpYear"],
          $_POST["Amount"]
          
      );
     
      $donorC->ajouterdonations($donor);
      header('Location:afficherorganisation.php');
  
  }
}
    else
        $error = "Missing information";
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
    

</head>
<body>

<div class="container">


    <form action="ajouterdonation.php" method="POST"  name="ajout" enctype="multipart/form-data">

        <div class="row">

            <div class="col">

                <h3 class="title">DONATION FORM</h3>

                <div class="inputBox">
                    <span>full name :</span>
                    <input type="text" placeholder="Name" name="Name" id="Name" required>
                    <span id="nameError" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>email :</span>
                    <input type="email" name="Email" id="Email" placeholder="example@example.com" required>
                    <span id="emailError" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>address :</span>
                    <input type="text" name="Address" id="address" placeholder="room - street - locality" required>
                    <span id="addError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>zip code :</span>
                        <input type="text" name="ZipCode" id="ZipCode"  placeholder="123 456" required>
                        <span id="ZCError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>Amount:</span>
                        <input type="number" name="Amount" placeholder="20$" required>
                        <span id="AMError" class="error-message"></span>
                </div>
                <div class="inputBox">
                        <span>choose your paiement method</span>
                      
                        <div class="flex"> 

                        <label for="option1">
                            <img src="images/other options.png" alt="card">
                            <input  type="radio" name="options" id="option1" value="option1" onclick="showForm()" required>
                            
                        </label>

                        <label for="option2">
                            <img src="images/paypal.png" alt="paypal">
                            <input  type="radio" name="options" id="option2" value="option2" onclick="showForm()">
                            
                        </label>
                    </div>
                 </div>

            </div>

            
            

             <div id="formContainer" class="col" >
                <h3 class="title">payment</h3>

             
                <div class="inputBox">
                    <span>name on card :</span>
                    <input type="text" name="CardName" placeholder="mr. " required>
                    <span id="NC" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>credit card number :</span>
                    <input type="number" name="CreditCardNum" id="CreditCardNum" placeholder="1111-2222-3333-4444" required>
                    <span id="CN" class="error-message"></span>

                </div>
                <div class="inputBox">
                    <span>Biling Adress:</span>
                    <input type="text" name="BilingAdress" placeholder="Card location account" required>
                    <span id="BA" class="error-message"></span>
                </div>
                <div class="inputBox">
                    <span>exp month :</span>
                    <input type="text" name="ExpMonth" id="ExpMonth" placeholder="january" required>
                    <span id="expm" class="error-message"></span>

                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>exp year :</span>
                        <input type="number" name="ExpYear" id="ExpYear" placeholder="2022" required>
                    <span id="expy" class="error-message"></span>

                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="number" name="Cvv" id="CVV" placeholder="1234" required>
                    <span id="CVV" class="error-message"></span>

                    </div>
                </div>

            </div>
    
        </div>
         
        <input type="submit" value="proceed to checkout" class="submit-btn">

    </form>

</div>    


<script src="js/donationform.js"></script>
</body>
</html>