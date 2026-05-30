<?php
	include_once '../Controller/donorC.php';
	include_once '../Model/donor.php';
	$don= new donorC();
	session_start();
	      
        $Name= $_POST["Name"];
        $Email= $_POST["Email"];
        $Address=$_POST["Address"];
        $CardName=$_POST["CardName"];
        $CreditCardNum=$_POST["CreditCardNum"];
        $BilingAdress=$_POST["BilingAdress"];	
        $ZipCode=$_POST["ZipCode"];
        $Cvv=$_POST["Cvv"]; 
        $ExpMonth=$_POST["ExpMonth"];		
        $ExpYear=$_POST["ExpYear"];
        $Amount=$_POST["Amount"];

		$donor=new donor($Name,$Amount, $Email, $Address, $CardName ,$CreditCardNum,$BilingAdress,$ZipCode,$Cvv,$ExpMonth,$ExpYear);
		$don->ajouterdonations($donor);
        ?>