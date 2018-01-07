<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>
<?php
  if(isset($_GET["active"])) {
    $active_status = $_GET["active"];

    $query  = "SELECT * FROM ";
    $query .= "admin_accounts WHERE ";
    $query .= "approved = 0";
    
    $result = mysqli_query($connection, $query);
    $active_alert = mysqli_affected_rows($connection);

  } else {
    redirect_to("admin_accounts.php?active=1");
  }
?>
<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>

<!-- Main Content - START -->
<div class="container push-md">
  <div class="row no-gutters mb-4">
  <?php echo message(); ?>
    <div class="col-6">
        <a href="user_accounts.php?active=1" role="button" class="btn btn-no-bg btn-lg btn-block">User Accounts</a>
    </div>
    <div class="col-6">
        <a href="admin_accounts.php?active=1" role="button" class="btn btn-no-bg btn-lg btn-block active">Admin Accounts</a>
    </div>
  </div>
  <div class="row no-gutters justify-content-center" >
    
    <!-- Accounts Menu - START -->
    
      <div class="col-6" >
            <a href="admin_accounts.php?active=1" role="button" class="btn btn-no-bg <?php if($active_status != 0) { echo "active"; } ?>">Active</a>
      </div>

      <div class="col-6 text-right" >
            <a href="add_admin.php" role="button" class="btn btn-blue">
            <i class="fa fa-plus mr-4" aria-hidden="true"></i> Add Account
            </a>
      </div>

  </div>
    <!-- Accounts Menu - END -->

  <!-- Accounts Info - START -->
  <div class="row mt-5">
    <div class="col">
      <table class="table table-striped table-sm" id="adminAccounts">
        <thead class="thead-blue">
          <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>View/Edit</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if($active_status != 0) {
              $query  = "SELECT * ";
              $query .= "FROM admin_accounts ";
              $result = mysqli_query($connection, $query);
            } else {
              $query  = "SELECT * ";
              $query .= "FROM admin_accounts ";
              $query .= "WHERE approved = 0 AND id != '{$_SESSION["logged_id"]}'";
              $result = mysqli_query($connection, $query);
            }

            if(mysqli_num_rows($result) != 0) {
              while($user = mysqli_fetch_assoc($result)) {
                echo '
                <tr>
                <td class="align-middle">'. $user["username"] .'</td>
                <td class="align-middle">'. $user["first_name"] .'</td>
                <td class="align-middle">'. $user["last_name"] .'</td>
                <td class="align-middle">'. $user["email"] .'</td>
                <td class="align-middle">
                <a href="edit_admin.php?id=' . $user["id"] .'" class="btn btn-blue">
                <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                </tr>
                ';
              }
            } else {
              echo '
              <tr class="text-center">
                <td colspan="5" class="pt-5 pb-5"><h2>No accounts to show.</h2></td>
              </tr>
              ';
            }
            mysqli_free_result($result);
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Accounts Info - START -->

</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>
