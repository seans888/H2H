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
        $query .= "customers_list WHERE id = {$current_id}";
        $result = mysqli_query($connection, $query);

        if(!$result) {
            die("Database query failed.");
        }

        while($customer = mysqli_fetch_assoc($result)) {
            $id = $customer["id"];
            $created_by = $customer["created_by"];
            $date_time = $customer["date_time"];
            $company_name = $customer["company_name"];
            $company_address= $customer["company_address"];
            $first_name= $customer["first_name"];
            $last_name = $customer["last_name"];
            $home_address = $customer["home_address"];
            $email = $customer["email"];
            $mobile = $customer["mobile"];
            $landline = $customer["landline"];
        }

    } else {
        redirect_to("customers_list.php");
    }
?>

<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>

<!-- Main Content - START -->
<div class="container push-md">
    <div class="row no-gutters">
        <?php echo message(); ?>
        <div class="col-lg-12">
            <h1>Edit Customer Info</h1>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">

    <div class="col-lg-8">
        <form action="../functions/edit_customer_admin.php" method="POST" id="customerInfo">
            <div class="form-group row">
                <label for="userId" class="col-sm-3 col-form-label">User Id</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="userId" id="userId" value="<?php echo $id ?>" readonly>
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
                <label for="companyName" class="col-sm-3 col-form-label">Company Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="companyName" id="companyName" value="<?php echo $company_name; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="companyAddress" class="col-sm-3 col-form-label">Company Address</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="companyAddress" name="companyAddress" placeholder="if applicable" rows="3"><?php echo $company_address; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="firstName" class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $first_name; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-3 col-form-label">Last name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $last_name; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="homeAddress" class="col-sm-3 col-form-label">Home Address</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="homeAddress" name="homeAddress" rows="3"><?php echo $home_address; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $mobile; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="landline" class="col-sm-3 col-form-label">Landline</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="landline" id="landline" value="<?php echo $landline; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" required>
                </div>
            </div>
          
            <div class="form-group row mt-5 mb-5">
                <div class="col-sm-4">
                    <button type="submit" id="update" name="update" class="btn btn-success btn-block"><i class="fa fa-pencil mr-2" aria-hidden="true"></i> Update info</button>
                </div>
                <div class="form-group col-lg-4">
                    <a href="../functions/delete_customer_admin.php?id=<?php echo $id; ?>" id="delete" role="button" class="btn btn-danger btn-block"><i class="fa fa-times mr-2" aria-hidden="true"></i> Delete</a>
                </div>
                <div class="col-sm-4">
                    <a href="customer_list.php" role="button" class="btn btn-blue btn-block"><i class="fa fa-minus mr-2" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
            
        </form>

    </div>

    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>