<?php
//include header.php
require_once 'header.php';

?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="alert alert-success alert-dismissible d-none" id="success-alert">
              <strong>Export successful!</strong> Please check the /storage folder.
            </div>
          <div class="card-header">
            
            
            <h4>Address Book
              <a href="create.php" class="btn btn-primary  float-end">Add Address</a>
              <a href="#" id="export" class="btn btn-primary button">Export </a></button>             
            </h4>
           
          </div>
          <div class="card-body">            
            <!-- Create Table -->
            <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th> Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Street</th>
                <th>Zip-code</th>
                <th>City</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
               <!-- Populate addresses table on User Interface -->
                  <?php
                      $addressesObj = new DatabaseQueries();
                      $alladdresses = $addressesObj->fetchAllAddresses();                                                                
                  ?>
                  <?php
                        foreach ($alladdresses as $address ){
                         
                    ?>
                    <tr>
                      <td><?=$address['id']?></td>
                      <td><?=$address['name']?></td>
                      <td><?=$address['first_name']?></td>
                      <td><?=$address['email']?></td>
                      <td><?=$address['street']?></td>
                      <td><?=$address['zipcode']?></td>
                      <td><?=$address['city']?></td>
                     
                      <td>
                        
                        <a href="edit.php?id=<?=$address['id']?>" class="btn btn-success btn-sm">Edit</a>
                        
                    </td>

                    </tr>
                     <?php

                   }
                      ?>

              
              <tr>
                 <td></td>
              </tr>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
require_once 'footer.php';

?>