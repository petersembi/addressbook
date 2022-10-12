<?php
//Class AddressUpdate
//Handles address update. 

Class AddressUpdate {
    private $db_connection = null;
    public $errors = array();
    public $messages = array();


    public function __construct()
    {
        if(isset($_POST["update_address"])){
            $this->updateAddress();
        }
    }

    private function updateAddress()
    {
        //check for length of email
        if(strlen($_POST['email']) > 64) 
        {
            $this->errors[] = "Email cannot be longer than 64 characters";
    
        } 
        //check for email validity
        elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $this->errors[] = "Your email address is not in a valid email format";
        } 
        //check for empty fields
        elseif(!empty($_POST['name'])||!empty($_POST['first_name'])||!empty($_POST['email'])||!empty($_POST['street'])||!empty($_POST['zipcode'])||!empty($_POST['city']))
        {
            //create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            //change character set to utf8
            if(!$this->db_connection->set_charset("utf8")){
                $this->errors[] = $this->db_connection->error;
            }

            //if no connection errors
            if (!$this->db_connection->connect_errno) {
                //escaping, and removing anything that could be html or javascript code
                $name = $this->db_connection->real_escape_string(strip_tags($_POST['name'], ENT_QUOTES));
                $first_name = $this->db_connection->real_escape_string(strip_tags($_POST['first_name'],ENT_QUOTES));
                $email = $this->db_connection->real_escape_string(strip_tags($_POST['email'], ENT_QUOTES));
                $street = $this->db_connection->real_escape_string(strip_tags($_POST['street'], ENT_QUOTES));
                $zipcode = $this->db_connection->real_escape_string(strip_tags($_POST['zipcode'], ENT_QUOTES));
                $city = $this->db_connection->real_escape_string(strip_tags($_POST['city'], ENT_QUOTES));
                $id = $this->db_connection->real_escape_string(strip_tags($_POST['address_id'], ENT_QUOTES));
               
                //update address
                $sql = "UPDATE addresses SET name='$name', first_name='$first_name', email='$email', street='$street', zipcode='$zipcode', city='$city' WHERE id='$id';";
                $query_address_update = $this->db_connection->query($sql);

                //if address has been added successfully
                if($query_address_update){
                    $this->messages[] = "Address succesfully updated";
                } else {
                    $this->errors[] = "Sorry, Address update failed. Please try again.";
                }
            } 
            else {
                $this->errors[]="Sorry, no database connection.";
            }
        
        }
        else {
            $this->errors[] = "An error occurred";
        }
    

    }

    public function fetchOneAddress($id){

        try {
             //create a database connection
             $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $sql = "SELECT * FROM addresses where id='$id';";
            $query_fetch_one_address = $this->db_connection->query($sql); 
          
            return $query_fetch_one_address->fetch_all(MYSQLI_ASSOC);
  
        } catch (Exception $e) {
           return $e->getMessage();
        }      
        
  
     }

}
?>