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
            <h1>Add New Facility Record</h1>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">

    <div class="col-lg-7">
        <form action="../functions/add_facility_admin.php" method="POST" id="userAccounts">
            
            <div class="form-group row">
                <label for="facilityID" class="col-sm-3 col-form-label">Facility Id</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="facilityID" id="facilityID" value="Auto generated" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="dateTime" class="col-sm-3 col-form-label">Date/Time</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="dateTime" id="dateTime" value="<?php echo date("Y-m-d h:i:sa"); ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="facilityName" class="col-sm-3 col-form-label">Facility Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="facilityName" id="facilityName" placeholder="Facility Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="facilityDescription" class="col-sm-3 col-form-label">Facility Description</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="facilityDescription" id="facilityDescription" placeholder="Facility Description" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="facilityFloor" class="col-sm-3 col-form-label">Facility Floor</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="facilityFloor" id="facilityFloor" placeholder="Facility Floor" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="facilityChecklist" class="col-sm-3 col-form-label">Facility Checklist</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="facilityChecklist" id="facilityChecklist" placeholder="Facility Checlist" required>
                </div>
            </div>
            <div class="form-group row pt-4">
                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Create Facility</button>
                </div>

                <div class="col-sm-6">
                    <a href="facility.php" role="button" class="btn btn-danger btn-block"><i class="fa fa-times mr-2" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>








    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>