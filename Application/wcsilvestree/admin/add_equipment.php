<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>

<!-- Main Content - START -->
<div class="container push-md">
    <div class="row no-gutters">
        <?php echo message(); ?>
        <div class="col-lg-12">
            <h1>Add New Equipment Record</h1>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">

    <div class="col-lg-7">
        <form action="../functions/add_equipment_admin.php" method="POST" id="customerRecord">
        
            <div class="form-group row">
                <label for="itemName" class="col-sm-3 col-form-label">Item name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="itemName" id="itemName" placeholder="Item Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="itemDescription" class="col-sm-3 col-form-label">Item description</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="itemDescription" id="itemDescription" placeholder="Item Description" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="itemLocation" class="col-sm-3 col-form-label">Item location</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="itemLocation" id="itemLocation" placeholder="Item Location" required>
                 
                </div>
            </div>
            <div class="form-group row">
                <label for="itemType" class="col-sm-3 col-form-label">Item type</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="itemType" id="itemType" placeholder="Item Type" required>
                </div>
            </div>
            <div class="form-group row pt-4">
                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Create record</button>
                </div>

                <div class="col-sm-6">
                    <a href="equipment.php" role="button" class="btn btn-danger btn-block"><i class="fa fa-times mr-2" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>


    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>