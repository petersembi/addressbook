<?php
//code to run in the database. 
class DatabaseQueries extends Dbh{
     protected function setAddress($name, $first_name, $email, $street, $zipcode, $city){
            $stmt = $this->connect()->prepare('INSERT INTO addresses (name,first_name,email,street,zipcode,city) VALUES
            (?, ?, ?, ?, ?, ?);');
      

            if (!$stmt->execute(array($name, $first_name, $email, $street, $zipcode, $city)) ){
               $stmt = null;

               header("location:../index.php?error=stmtfailed");
               exit();
            }
            $stmt = null;
    }


    protected function addressUpdate($name, $first_name, $email, $street, $zipcode, $city,$id){
            $stmt = $this->connect()->prepare("UPDATE addresses SET name=?, first_name=?, email=?, street=?, zipcode=?, city=? WHERE id='$id';");   

            if (!$stmt->execute(array($name, $first_name, $email, $street, $zipcode, $city)) ){
               $stmt = null;

               header("location:../index.php?error=stmtfailed");
               exit();
            }
            $stmt = null;
            
   }

   public function getCities(){
      $sql = "SELECT * FROM cities";       
      $stmt = $this->connect()->query($sql);
      return $stmt->fetchAll();        
  
   }

   public function getCitiesStmt ($firstname, $lastname){
      $sql = "SELECT * FROM cities WHERE id = ? AND name = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$firstname, $lastname]);
      $names = $stmt->fetchAll();

      foreach($names as $name){
          echo $name['name'].'<br>';
      }
   }



   public function fetchAllAddresses(){
      
      try {
         $sql = "SELECT * FROM addresses";       
         $stmt = $this->connect()->query($sql);
         return $stmt->fetchAll(); 

      } catch (Exception $e) {
         return $e->getMessage();
      }      
         
   }
  
  
   public function fetchOneAddress($id){

      try {
         $stmt = $this->connect()->prepare("SELECT * FROM addresses where id=?");
      
         $stmt->execute([$id]);
         return $stmt->fetchAll();

      } catch (Exception $e) {
         return $e->getMessage();
      }      
      

   }

   public function exportToJson (){
      $sql = "SELECT * FROM addresses";       
      $stmt = $this->connect()->query($sql);
      $allAddresses = $stmt->fetchAll(); 
    

         $fp = fopen('storage/addresses.json','w');
         fwrite($fp, json_encode($allAddresses));
         fclose($fp);

   }

   public function exportToXml(){

      try {
               $sql = "SELECT * FROM addresses";       
               $stmt = $this->connect()->query($sql);           
               
               $dom   = new DOMDocument( '1.0', 'utf-8' );
               $dom   ->formatOutput = True;
               $root  = $dom->createElement( 'addressbook' );
               $dom   ->appendChild( $root );     
            
               while($row=$stmt->fetch(PDO::FETCH_ASSOC)){ 
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