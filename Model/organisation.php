<?php

Class organisation{
   private $id;
   private $name;
   private $details;
   private $adress;
   private $image;
   

public  function __construct($name,$details,$adress,$image)
{
    $this->name=$name;
    $this->details=$details;
    $this->adress=$adress;
    $this->image=$image;

}
public  function getname(){
    return $this->name;
}
public function getdetails(){
    return $this->details;
}
public  function getadress(){
    return $this->adress;
}
public  function getimage(){
    return $this->image;
}
public  function setname(string $name){
    $this->name=$name;
}
public  function setdetails(string $details){
    $this->details=$details;
}
public  function setadress(string $adress){
    $this->adress=$adress;
}
public  function setimage(string $image){
    $this->image=$image;
}


}
?>
