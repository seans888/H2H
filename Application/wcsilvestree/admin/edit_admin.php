<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php
    if(isset($_GET["id"])) {
        $current_id = $_GET["id"];
        $query  = "SELECT * FROM ";
        $query .= "admin_accounts WHERE id = {$current_id}";
        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Database query failed.");
        }

        while($user = mysqli_fetch_assoc($result)) {
            $user_id = $user["id"];
            $user_username = $user["username"];
            $user_first_name= $user["first_name"];
            $user_last_name = $user["last_name"];
            $user_email = $user["email"];
            $user_mobile = $user["mobile"];
            $user_landline = $user["landline"];
            $created_by = $user["created_by"];
            $date_time = $user["date_time"];
            $status = $user["approved"];
        }

        if($status == 0) {
            $action = "Pending";
            $options = '
            <div class="form-group row mt-5 mb-5">
                <div class="col-sm-3">
                    <button type="submit" name="approve" id="approve" class="btn btn-success btn-block"><i class="fa fa-check mr-2" aria-hidden="true"></i> Approve</button>
                </div>
                <div class="col-sm-3">
                    <button type="submit" name="update" id="update" class="btn btn-warning btn-block text-white"><i class="fa fa-pencil mr-2" aria-hidden="true"></i> Update</button>
                </div>
                <div class="col-sm-3">
                <a href="../functions/delete_admin.php?id=' . $current_id . '" id="delete" role="button" class="btn btn-danger btn-block"><i class="fa fa-times mr-2" aria-hidden="true"></i> Delete</a>
                </div>
                <div class="col-sm-3">
                    <a href="admin_accounts.php" role="button" class="btn btn-primary btn-block"><i class="fa fa-minus mr-2" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
            ';
        } else {
            $action = "Edit";
            $options = '
            <div class="form-group row mt-5 mb-5">
                <div class="col-sm-4">
                    <button type="submit" id="update" name="update" class="btn btn-success btn-block"><i class="fa fa-pencil mr-2" aria-hidden="true"></i> Update account</button>
                </div>
                <div class="col-sm-4">
                <a href="../functions/delete_admin.php?id=' . $current_id . '" id="delete" role="button" class="btn btn-danger btn-block"><i class="fa fa-times mr-2" aria-hidden="true"></i> Delete</a>
                </div>
                <div class="col-sm-4">
                    <a href="admin_accounts.php" role="button" class="btn btn-blue btn-block"><i class="fa fa-minus mr-2" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
            ';
        }

    } else {
        redirect_to("accounts.php");
    }
?>

<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>

<!-- Main Content - START -->
<div class="container push-md">
    <div class="row no-gutters">
        <?php echo message(); ?>
        <div class="col-lg-12">
            <h1><?php echo $action; ?> Admin Account</h1>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">

    <div class="col-lg-8">
        <form action="../functions/edit_admin.php" method="POST" id="adminAccounts">
            <div class="form-group row">
                <label for="userId" class="col-sm-3 col-form-label">User Id</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="userId" id="userId" value="<?php echo $user_id ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="createdBy" class="col-sm-3 col-form-label">Created by</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="createdBy" id="createdBy" value="<?php echo $created_by ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="dateTime" class="col-sm-3 col-form-label">Date/Time Created</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="dateTime" id="dateTime" value="<?php echo $date_time ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $user_username; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Change Password</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="password" id="password" placeholder="Enter new password" >
                </div>
            </div>
            <div class="form-group row">
                <label for="confirmPassword" class="col-sm-3 col-form-label">&nbsp;</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm new password" >
                </div>
            </div>
            <div class="form-group row">
                <label for="firstName" class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $user_first_name; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-3 col-form-label">Last name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $user_last_name; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $user_email; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $user_mobile; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="landline" class="col-sm-3 col-form-label">Landline</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="landline" id="landline" value="<?php echo $user_landline; ?>" required>
                </div>
            </div>

            <?php echo $options; ?>
        </form>
    </div>

    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>