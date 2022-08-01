<?php
// This file majorly contains error handling.
class AddressController extends DatabaseQueries {  
    
   private $name ;
   private $first_name;
   private $email;
   private $street;
   private $zipcode;
   private $city;
   private $id=0; //used only when updating the addresses. when creating the addresses the id is autoincremented. 

   public function __construct($name,$first_name, $email,$street,$zipcode,$city)
   {
    $this->name = $name;
    $this->first_name = $first_name;
    $this->email = $email;
    $this->street = $street;
    $this->zipcode = $zipcode;
    $this->city = $city;
   }

   

   //ERROR HANDLING
   //method to check for empty inputs
   private function emptyInput(){
        $result = null;

        if(empty($this->name)||empty($this->first_name)||empty($this->email)||empty($this->street)||empty($this->zipcode)||empty($this->city)){
            $result = true;
        }
        else {
            $result = false;
        }
   }

   //method to check for invalid name
   private function invalidName(){
        $result = null;

        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->name)) {
            $result = true;
        }
        else 
        {
            $result = false;
        }
   }

   //method to check if email is valid
   private function invalidEmail(){
        $result = null;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = true;

        }
        else{
            $result = false;
        }

   }


//CODE TO ACT ON DATABASE

   public function createAddress (){
        if($this->emptyInput()==true) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        if($this->invalidName()==true) {
            header("location: ../index.php?error=name");
            exit();
        }

        if($this->invalidEmail()==true) {
            header("location: ../index.php?error=name");
            exit();
        }

        $this->setAddress($this->name,$this->first_name,$this->email, $this->street, $this->zipcode, $this->city);
   }

 
   

   public function updateAddress ($id){
    //error checks
                if($this->emptyInput()==true) {
                    header("location: ../index.php?error=emptyinput");
                    exit();
                }

                if($this->invalidName()==true) {
                    header("location: ../index.php?error=name");
                    exit();
                }

                if($this->invalidEmail()==true) {
                    header("location: ../index.php?error=email");
                    exit();
                }
        //set id value
        $this->id = $id;
        
        //call addressUpdate function which has the database query
        $this->addressUpdate($this->name,$this->first_name,$this->email, $this->street, $this->zipcode, $this->city, $this->id);
   }

 }









?>