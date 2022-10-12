<?php
//Class Registration
//Handles address registration. 

Class AddressRegistration {
    private $db_connection = null;
    public $errors = array();
    public $messages = array();
   

    public function __construct()
    {
        if(isset($_POST["save_address"])){
            $this->registerNewAddress();
        }
    }

    

    private function registerNewAddress()
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
               
                //write new user's data into database
                $sql = "INSERT INTO addresses (name, first_name, email, street, zipcode, city) VALUES('".$name."','".$first_name."','".$email."','".$street."','".$zipcode."', '".$city."');";
                $query_new_address_insert = $this->db_connection->query($sql);

                //if address has been added successfully
                if($query_new_address_insert){
                    $this->messages[] = "Address succesfully added";
                } else {
                    $this->errors[] = "Sorry, Address addition failed. Please try again.";
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
    public function getCities(){
        //create a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
        $sql = "SELECT * FROM cities";      
        $query_fetch_addresses = $this->db_connection->query($sql); 
        
        return $query_fetch_addresses->fetch_all(MYSQLI_ASSOC);        
    
     }

     public function getAddresses(){
        //create a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
        $sql = "SELECT * FROM addresses";      
        $query_fetch_addresses = $this->db_connection->query($sql); 
        
        return $query_fetch_addresses->fetch_all(MYSQLI_ASSOC);        
    
     }

     
    public function exportToJson (){
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
        $sql = "SELECT * FROM addresses";      
        $query_fetch_addresses = $this->db_connection->query($sql); 
        
        $allAddresses= $query_fetch_addresses->fetch_assoc(); 
      
  
           $fp = fopen('storage/addresses.json','w');
           fwrite($fp, json_encode($allAddresses));
           fclose($fp);
  
     }
  
     public function exportToXml(){
  
        try {
                $sql = "SELECT * FROM addresses";      
                $query_fetch_addresses = $this->db_connection->query($sql); 

                 $dom   = new DOMDocument( '1.0', 'utf-8' );
                 $dom   ->formatOutput = True;
                 $root  = $dom->createElement( 'addressbook' );
                 $dom   ->appendChild( $root );     
              
                 while($row = $query_fetch_addresses->fetch_assoc()){ 
                    $node = $dom->createElement('address');
                    foreach($row as $key => $val){
                       $child = $dom->createElement($key);
                       $child->appendChild($dom->createCDATASection($val));
                       $node ->appendChild($child);
                    }
                    $root->appendChild($node);
                 }
                 $dom->save('storage/address.xml');
                          
                          
  
           } catch (Exception $e) {
                    return $e->getMessage();
           }    
       
       
  
     }
}
?>