<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php
  $query  = "SELECT * FROM ";
  $query .= "inventory WHERE ";
  $query .= "item_quantity = 0";
  
  $result = mysqli_query($connection, $query);
  $affected_rows = mysqli_affected_rows($connection);

  if(!$result) {
    die("Database query failed.");
  } else {
    if($affected_rows === 0) {
      $message = "<div class=\"card-header\">All facilities are good</div>";
      $icon = "<div class=\"card-title\" id=\"good\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i></div>";
      $button = "<a href=\"facility.php\" role=\"button\" class=\"btn btn-success btn-block\">View</a>";
    } else {
      $message = "<div class=\"card-header\">{$affected_rows} item(s) are out of stock</div>";
      $icon = "<div class=\"card-title\" id=\"bad\"><i class=\"fa fa-times-circle\" aria-hidden=\"true\"></i></div>";
      $button = "<a href=\"inventory.php?stock=0\" role=\"button\" class=\"btn btn-danger btn-block\">View</a>";
    }
  }
?>

<?php
  $users_table  = "SELECT * FROM ";
  $users_table .= "user_accounts WHERE ";
  $users_table .= "approved = 0";
  
  $users_results = mysqli_query($connection, $users_table);
  $users_rows = mysqli_affected_rows($connection);

  $admins_table  = "SELECT * FROM ";
  $admins_table .= "admin_accounts WHERE ";
  $admins_table .= "approved = 0";
  
  $admins_results = mysqli_query($connection, $admins_table);
  $admins_rows = mysqli_affected_rows($connection);

  $total_count = $users_rows + $admins_rows;

  echo $total_count;
  if($total_count == 0) {
    $accounts_msg = "<div class=\"card-header\">No pending fixes.</div>";
    $accounts_icon = "<div class=\"card-title\" id=\"good\"><i class=\"fa fa-check-circle\" aria-hidden=\"true\"></i></div>";
    $accounts_button = "<a href=\"equipment.php\" role=\"button\" class=\"btn btn-success btn-block\">View</a>";
  } else {
    $accounts_msg = "<div class=\"card-header\">{$total_count} pending account(s).</div>";
    $accounts_icon = "<div class=\"card-title\" id=\"warning\"><i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i></div>";
    $accounts_button = "<a href=\"user_accounts.php?active=0\" role=\"button\" class=\"btn btn-warning btn-block text-white\">View</a>";
  }
?>

<?php

  // get orders
  $pending = 0;
  $approved = 0;
  $rejected = 0;
  $order = "SELECT status,COUNT(*) AS count FROM orders GROUP BY status";
  $order_query = mysqli_query($connection, $order);
  if(mysqli_num_rows($order_query) != 0) {
    while($orders = mysqli_fetch_assoc($order_query)) {
      if($orders["status"] == 0) {
        $pending = $orders["count"];
      } elseif ($orders["status"] == 1) {
        $approved = $orders["count"];
      } else {
        $rejected = $orders["count"];
      }
    }
  } else {
    $pending = 0;
    $approved = 0;
    $rejected = 0;
  }

?>



<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>

<!-- Main Content - START -->
<div class="container-fluid push-md"> <!-- container - start -->
  <div class="row"> <!-- row - start -->

    
    <!-- Sales Report - START -->
    <div class="col-lg-6">
          <div class="row">
          <div class="col-lg-12">
            <div class="card" id="dateToday">
              <div class="card-body text-center bg-blue">
                <h4 class="text-white"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> 
                    Upcoming Events
                </h4>
              </div>    
            </div>
          </div>
        </div>
          <div class="card mb-3 text-center">
              <div class="card-header"><h1>Fiscal Year: <?php echo date("Y"); ?></h1></div>
              <div class="card-body">
                <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=silvestrewes%40gmail.com&amp;color=%231B887A&amp;ctz=Asia%2FManila" style="border-width:0" width="750" height="600" frameborder="0" scrolling="no"></iframe>
              </div>
          </div>
      </div>
      <!-- Sales Report - START -->

      <div class="col-lg-6"> <!-- col-lg-6 -->

        <div class="row">
          <div class="col-lg-12">
            <div class="card" id="dateToday">
              <div class="card-body text-center bg-blue">
                <h4 class="text-white"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> 
                    Today: <span class="bold ml-2"><?php echo date("m-d-Y") .'-'. date("l"); ?></span>
                </h4>
              </div>    
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <!-- Inventory Status - START -->
          <div class="col-lg-6" id="inventoryStatus">
            <h3>Facility <span class="text-muted">Status</span></h3>
            <div class="card mb-3 text-center">
              <?php echo $message; ?>
                <div class="card-body">
                  <?php echo $icon; ?>
                </div>
                <div class="card-footer bg-transparent">
                  <?php echo $button; ?>
                </div>
            </div>
          </div>
          <!-- Inventory Status - END -->

          <!-- Accounts Status - START -->
          <div class="col-lg-6" id="accountsStatus">
            <h3>Equipment <span class="text-muted">Status</span></h3>
            <div class="card mb-3 text-center">
                <?php echo $accounts_msg; ?>
                <div class="card-body">
                  <?php echo $accounts_icon; ?>
                </div>
                
                <div class="card-footer bg-transparent">
                    <?php echo $accounts_button; ?>
                </div>
            </div>
          </div>
          <!-- Accounts Status - END -->
        </div>

        <div class="row mt-3">
          <!-- Orders Status - START -->
          <div class="col-lg-12" id="inventoryStatus">
            <h3>Summary <span class="text-muted"></span></h3>
            <div class="card mb-3 text-center">
                <div class="card-body"> <!-- card-body -->

                  <div class="row">

                    <div class="col-lg-4">
                        <div class="card text-white bg-success mb-3" style="max-width: 15rem;">
                        <div class="card-header">Fixed Facilities</div>
                        <div class="card-body">
                          <h1 class="card-title"><?php echo $approved; ?></h1>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card bg-light mb-3" style="max-width: 15rem;">
                        <div class="card-header">Pending Fixes</div>
                        <div class="card-body">
                          <h1 class="card-title"><?php echo $pending; ?></h1>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card text-white bg-danger mb-3" style="max-width: 15rem;">
                        <div class="card-header">Buffer Limits</div>
                        <div class="card-body">
                          <h1 class="card-title"><?php echo $rejected; ?></h1>
                        </div>
                      </div>
                    </div>

                  </div>

                
            </div>
          </div>
          <!-- Orders Status - END -->
        </div>

      </div> <!-- col-lg-6 -->

  </div> <!-- row -end -->
</div> <!-- container - end -->
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>