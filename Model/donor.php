<?php
    class donor
    {
        private $id_donation;
        private $Name;
        private $Amount;
        private $Email;
        private $Address;
        private $CardName;
        private $CreditCardNum;
        private $BilingAdress;	
        private $ZipCode;
        private $Cvv; 
        private $ExpMonth;		
        private $ExpYear;
        private $id_organisation;
        
        public function __construct($Name,$Email,$Amount,$Address,$CardName,$CreditCardNum,$BilingAdress,$Cvv,$ExpMonth,$ExpYear,$ZipCode,$id_organisation){
            
            $this->Name = $Name;
            $this->Amount = $Amount;
            $this->Email = $Email;
            $this->Address = $Address;
            $this->CardName = $CardName;
            $this->CreditCardNum = $CreditCardNum;
            $this->BilingAdress = $BilingAdress;
            $this->ZipCode = $ZipCode;
            $this->Cvv = $Cvv; 
            $this->ExpMonth	= $ExpMonth;
            $this->ExpYear = $ExpYear;
            $this->id_organisation = $id_organisation;
            
            
        }
        
        public function getid_donation () {
            return $this->id_donation;
        }

        public function setid_donation($id_donation){
            $this->id_donation = $id_donation;
        } 

        public function getid_organisation () {
            return $this->id_organisation;
        }

        public function setid_organisation($id_organisation){
            $this->id_organisation = $id_organisation;
        } 

        public function getName () {
            return $this->Name;
        }

        public function setName ($Name){
            $this->Name = $Name;
        } 

        public function getEmail () {
            return $this->Email;
        }

        public function setEmail ($Email){
            $this->Email = $Email;
        }

        public function getAddress () {
            return $this->Address;
        }

        public function setAddress ($Address){
            $this->Address = $Address;
        }

        public function getCardName () {
            return $this->CardName;
        }

        public function setCardName  ($CardName){
            $this->CardName = $CardName;
        }
        public function getCreditCardNum () {
            return $this->CreditCardNum;
        }

        public function setCreditCardNum ($CreditCardNum){
            $this->CreditCardNum = $CreditCardNum;
        } 
        public function getBilingAdress () {
            return $this->BilingAdress;
        }

        public function setBilingAdress ($BilingAdress){
            $this->BilingAdress = $BilingAdress;
        }
        public function getZipCode () {
            return $this->ZipCode;
        }

        public function setZipCode ($ZipCode){
            $this->ZipCode = $ZipCode;
        }
        public function getCvv () {
            return $this->Cvv;
        }

        public function setCvv ($Cvv){
            $this->Cvv = $Cvv;
        }
        public function getExpMonth () {
            return $this->ExpMonth;
        }

        public function setExpMonth ($ExpMonth){
            $this->ExpMonth = $ExpMonth;
        }
        public function getExpYear () {
            return $this->ExpYear;
        }

        public function setExpYear ($ExpYear){
            $this->ExpYear = $ExpYear;
        }
       

        public function getAmount() {
            return $this->Amount;
        }

        public function setAmount ($Amount){
            $this->Amount = $Amount;
        }
    }
?>