<?php
require 'header.php';
?> 

<div class="container mt-5">
  <!-- Address creation form -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Add Address <a href="index.php" class="btn btn-success float-end">Addresses</a>
          </h4>
        </div>
        <div class="card-body">
          <form action="index.php" method="POST">
            <div class="mb-3">
              <label for="name"> Name</label>
              <input type="text" id="name" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
              <label for="first_name"> First Name</label>
              <input type="text" id="first_name" class="form-control" name="first_name" required>
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" id="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
              <label for="street">Street</label>
              <input type="text" id="street" class="form-control" name="street" required>
            </div>
            <div class="mb-3">
              <label for="zipcode">Zip code</label>
              <input type="text" id="zipcode" class="form-control" name="zipcode" required>
            </div>
            <div class="mb-3">
              <label for="city">Select City</label> <?php
                            $citiesObj = new Address();                                                     
                            $allCities = $citiesObj->getCities();                 
                            ?> <select name="city" id="city" class="form-control dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" required> <?php

                               foreach ($allCities as $city ){
                                ?> <option> <?= $city['name']?> </option> <?php
                                        }
                                        ?> </select>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary" name="save_address">Save Address</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> 

<?php
require 'footer.php'
?>