<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>


<!-- Main Content - START -->
<div class="container-fluid push-md">
  <div class="row no-gutters justify-content-between">

    <!-- Inventory Menu - START -->
      <?php echo message(); ?>
      <div class="col-1 col-sm-2 col-md-6 col-lg-6">
       <h1>Equipment List</h1>
      </div>
      <div class="col-1 col-sm-2 col-md-6 col-lg-6" id="totalAccountsContainer">
        <div class="float-right">
          <a href="add_equipment.php" role="button" class="btn btn-blue" id="addItem"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Add New Record</a>
        </div>
      </div>
    <!-- Inventory Menu - END -->
  </div>

  <!-- Inventory List - START -->
  <div class="row mt-5 mb-5">
    <div class="col">
      <table class="table table-striped table-sm" id="customersTable">
        <thead class="thead-blue">
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Type</th>
           
          </tr>
        </thead>
        <tbody>
        <?php
            
              $query  = "SELECT * ";
              $query .= "FROM equipement";
              $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) != 0) {
              while($customer = mysqli_fetch_assoc($result)) {
                echo '
                <tr>
                <td class="align-middle">'. htmlentities($customer["id"]) .'</td>
                <td class="align-middle">'. htmlentities($customer["item_name"]) .'</td>
                <td class="align-middle">'. htmlentities($customer["item_description"]) .'</td>
                <td class="align-middle">'. htmlentities($customer["item_location"]) .'</td>
                <td class="align-middle">'. htmlentities($customer["item_type"]) .'</td>
           
            
                ';
              }
            } else {
              echo '
              <tr class="text-center">
                <td colspan="10" class="pt-5 pb-5"><h2>No customer info found</h2></td>
              </tr>
              ';
            }
            mysqli_free_result($result);
          ?>
         
        </tbody>
      </table>
    </div>
  </div>
  <!-- Inventory List - END -->

</div>
<!-- Main Content - END -->
