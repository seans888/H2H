<?php require_once("../functions/sessions.php"); ?>

<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>
<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>

<?php
    if(isset($_GET["id"])) {
        $order_id = $_GET["id"];
    }
?>

<?php

    
?>

<!-- Main Content - START -->
<div class="container-fluid push-md">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h1>Add New Order</h1>
        </div>
        <div class="col-lg-6 text-right">
            <div class="form-group row pt-4">
                <div class="col-sm-6">
                    <a href="add_order_1.php" role="button" class="btn btn-danger btn-block"><i class="fa fa-angle-left mr-2" aria-hidden="true"></i> Cancel</a>
                </div>

                <div class="col-sm-6">
                    <a href="add_order_3.php?id=<?php echo $order_id; ?>" role="button" class="btn btn-primary btn-block">Next Step<i class="fa fa-angle-right ml-2" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-6">
            <h3>Step 2: &nbsp;Select an Item</h3>
              <p>
                   If the item is not listed it is out of stock. Click <a href="inventory.php?stock=0">here</a> to check the item.</small>
              </p>
        </div>
        <div class="col-lg-6">
            <h3>Selected Items</h3>
            <p>Total amount will be computed at Step 3</p>
        </div>
    </div>
   

    <div class="row mt-4">
    <div class="col-lg-6">
    <table class="table table-striped table-sm">
        <thead class="thead-blue">
          <tr>
            <th>Item #</th>
            <th>Name</th>
            <th>Price (each)</th>
            <th>In stock</th>
            <th>Status</th>
            <th>Quantity</th>
            <th>Add Item</th>
          </tr>
        </thead>
        <tbody>
        
         <?php

              $query  = "SELECT * ";
              $query .= "FROM inventory ";
              $query .= "WHERE item_quantity != 0";
              $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) != 0) {
              while($item = mysqli_fetch_assoc($result)) {
                if($item["status"] == 1) {
                    $item["status"] = "Brand New";
                } else {
                    $item["status"] = "Used";
                }

                echo "<form action=\"../functions/add_order_2_admin.php?id=".$order_id."\" method=\"POST\">";
                echo "<tr>";
                echo "<td class=\"align-middle\">";
                echo "<input type=\"hidden\" id=\"item_id\" name=\"item_id\" value=\"".$item["id"]."\">";
                echo $item["id"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo htmlentities($item["item_name"]);
                echo "<input type=\"hidden\" id=\"item_name\" name=\"item_name\" value=\"".$item["item_name"]."\">";
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["item_price"];
                echo "<input type=\"hidden\" id=\"item_price\" name=\"item_price\" value=\"".$item["item_price"]."\">";
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["item_quantity"];
                echo "<input type=\"hidden\" id=\"item_instock\" name=\"item_instock\" value=\"".$item["item_quantity"]."\">";
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo $item["status"];
                echo "<input type=\"hidden\" id=\"item_status\" name=\"item_status\" value=\"".$item["status"]."\">";
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo "<input type=\"text\" id=\"item_quantity\" name=\"item_quantity\">";
                echo "</td>";
                echo "<td class=\"align-middle text-center\">";
                echo "<input type=\"hidden\" id=\"order_id\" name=\"order_id\" value=\"".$order_id."\">";
                echo "<button type=\"submit\" name=\"submit\" id=\"select_button\" class=\"btn btn-blue\">";
                echo "<i class=\"fa fa-plus\" aria-hidden=\"true\"></i></button>";
                echo "</td>";
                echo "</tr>";
                echo "</form>";
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

    <div class="col-lg-6">
       <table class="table table-striped table-sm">
        <thead class="thead-blue">
          <tr>
            <th>Item #</th>
            <th>Name</th>
            <th>Price (each)</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
         <?php

              $query2  = "SELECT * ";
              $query2 .= "FROM ordered_items ";
              $query2 .= "WHERE order_number = {$order_id}";
              $result2 = mysqli_query($connection, $query2);

              if(!$result2) {
                  die("Database query failed. " . mysqli_error($connection));
              }

            if(mysqli_num_rows($result2) != 0) {
              while($item2 = mysqli_fetch_assoc($result2)) {
                if($item2["status"] == 0) {
                  $item2["status"] = "Used";
                } else {
                  $item2["status"] = "Brand New";
                }
               
                echo "<form action=\"../functions/delete_order_items_admin.php?id=".$item2["order_number"]."\" method=\"POST\">";
                echo "<tr>";
                echo "<td class=\"align-middle\">";
                echo "<input type=\"hidden\" id=\"item_id\" name=\"item_number\" value=\"".$item2["item_number"]."\">";
                echo $item2["item_number"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo "<input type=\"hidden\" id=\"item_name\" name=\"item_name\" value=\"".$item2["item_name"]."\">";
                echo htmlentities($item2["item_name"]);
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo number_format($item2["item_price"],2);
                echo "<input type=\"hidden\" id=\"item_price\" name=\"item_price\" value=\"".$item2["item_price"]."\">";
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo "<input type=\"hidden\" id=\"item_quantity\" name=\"item_quantity\" value=\"".$item2["item_quantity"]."\">";
                echo $item2["item_quantity"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo htmlentities($item2["status"]);
                echo "<input type=\"hidden\" id=\"item_status\" name=\"item_status\" value=\"".$item2["status"]."\">";
                echo "</td>";
                echo "<td class=\"align-middle text-center\">";
                echo "<input type=\"hidden\" id=\"order_id\" name=\"order_number\" value=\"".$item2["order_number"]."\">";
                echo "<button type=\"submit\" name=\"submit\" id=\"delete_button\" class=\"btn btn-danger\">";
                echo "<i class=\"fa fa-times\" aria-hidden=\"true\"></i></button>";
                echo "</td>";
                echo "</tr>";
                echo "</form>";
              }
            }
            else {
              echo '
              <tr class="text-center">
                <td colspan="12 " class="pt-5 pb-5"><h2><i class="fa fa-plus mr-2" aria-hidden="true"></i>Add items</h2></td>
              </tr>
              ';
            }
            mysqli_free_result($result2);
         ?>
        </tbody>
      </table>
    </div>


    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>