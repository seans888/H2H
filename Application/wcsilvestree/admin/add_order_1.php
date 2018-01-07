<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php
    // get last order number
    
?>

<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>

<!-- Main Content - START -->
<div class="container push-md">
    <div class="row no-gutters">
        <?php echo message(); ?>
        <div class="col-lg-12">
            <h1>Add New Order</h1>
        </div>
    </div>
    <hr />
    <h3>Step 1: &nbsp;Select Customer</h3>
    <p>
        If the customer name is not listed, click <a href="add_customer.php">here</a> to add the record.</small>
    </p>
    <div class="row justify-content-center mt-4">

    <div class="col-lg-6">
    
        <form action="../functions/add_order_1_admin.php" method="POST" id="userAccounts">
            <div class="form-group row">
                    <select class="form-control" name="orderedBy" id="orderedBy" required>
                        <option value="" disabled selected>Name / Company</option>
                        <?php
                            $query = "SELECT * FROM customers_list";
                            $result = mysqli_query($connection, $query);
                            if(!$result) {
                                die("Database connection failed. " . mysqli_error($connection));
                            }
                            while($customer = mysqli_fetch_assoc($result)) {
                                $customer_name = ucfirst($customer["first_name"]) . " " . ucfirst($customer["last_name"]);
                                $company_name = ucfirst($customer["company_name"]);
                                echo "<option value=\"";
                                echo htmlentities($customer_name);
                                echo "\">";
                                echo htmlentities($customer_name);
                                echo " / ";
                                echo htmlentities($company_name);
                                echo "</option>";
                            }
                        ?>
                    </select>
            </div>
            <div class="form-group row pt-4">
                <div class="col-sm-6">
                    <a href="orders.php" role="button" class="btn btn-danger btn-block"><i class="fa fa-angle-left mr-2" aria-hidden="true"></i> Cancel</a>
                </div>

                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Next Step<i class="fa fa-angle-right ml-2" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>








    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>