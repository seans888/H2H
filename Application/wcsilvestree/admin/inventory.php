<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php require_once("../functions/count_out_of_stock.php"); ?>

<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>


<!-- Main Content - START -->
<div class="container-fluid push-md">
  <div class="row no-gutters justify-content-between">

    <!-- Inventory Menu - START -->
      <?php echo message(); ?>
      <div class="col-1 col-sm-2 col-md-6 col-lg-6">
       <h1>Inventory Reports</h1>
      </div>
      <div class="col-1 col-sm-2 col-md-6 col-lg-6" id="totalAccountsContainer">
        <div class="float-right">
          <a href="add_item.php" role="button" class="btn btn-blue" id="addItem"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Add New Item</a>
        </div>
      </div>
      <div class="col-lg-12 mt-4">
        <form>
          <a href="inventory.php?stock=1" role="button" class="btn btn-no-bg <?php if($stock_status !=0) { echo "active"; } ?>">In stock</a>
          <a href="inventory.php?stock=0" role="button" class="btn btn-no-bg <?php if($stock_status == 0) { echo "active"; } ?>">Out of Stock <span class="badge badge-secondary ml-2"><?php echo $stocks_alert; ?></span></a>
        </form>
      </div>
    <!-- Inventory Menu - END -->
  </div>

  <!-- Inventory List - START -->
  <div class="row mt-5 mb-5">
    <div class="col">
      <table class="table table-striped table-sm" id="inventory">
        <thead class="thead-blue">
          <tr>
            <th>Item #</th>
            <th>Name</th>
            <th>Model</th>
            <th>Year</th>
            <th>Series</th>
            <th>Quantity</th>
            <th>Price (each)</th>
            <th>Registration #</th>
            <th>Status</th>
            <th>Processed by</th>
            <th>Date/Time</th>
            <th>View/Edit</th>
          </tr>
        </thead>
        <tbody>
         <?php
            if($stock_status != 0) {
              $query  = "SELECT * ";
              $query .= "FROM inventory ";
              $query .= "WHERE item_quantity != 0";
              $result = mysqli_query($connection, $query);
            } else {
              $query  = "SELECT * ";
              $query .= "FROM inventory ";
              $query .= "WHERE item_quantity = 0";
              $result = mysqli_query($connection, $query);
            }
            if(mysqli_num_rows($result) != 0) {
              while($item = mysqli_fetch_assoc($result)) {
                if($item["status"] == 1) {
                    $item["status"] = "Brand New";
                } else {
                    $item["status"] = "Used";
                }
                
                echo "<tr>";
                echo "<td class=\"align-middle\">";
                echo $item["id"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo htmlentities($item["item_name"]);
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo htmlentities($item["item_model"]);
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["item_year"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo htmlentities($item["item_series"]);
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["item_quantity"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["item_price"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo htmlentities($item["reg_no"]);
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["status"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["processed_by"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["date_time"];
                echo "</td>";
                echo "<td class=\"align-middle text-center\">";
                echo "<a href=\"edit_item.php?id=" . $item["id"] ."\" class=\"btn btn-blue\">";
                echo "<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>";
                echo "</a>";
                echo "</td>";
                echo "</tr>";
              }
            }
            else {
              echo '
              <tr class="text-center">
                <td colspan="12 " class="pt-5 pb-5"><h2>No items found</h2></td>
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
<?php include("../layouts/footer.php"); ?>