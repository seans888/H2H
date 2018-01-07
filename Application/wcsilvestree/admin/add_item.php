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
            <h1>Add New Item</h1>
        </div>
        <small class="text-muted">
            Item Number for each entry are auto generated.
        </small>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
        <form action="../functions/add_item_admin.php" method="POST" name="addItem" id="addItem">
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="itemName" class="col-form-label">Item Name</label>
                    <input type="text" class="form-control" name="itemName" id="itemName" required>
                </div>
                <div class="form-group col-lg-4">
                    <label for="itemModel" class="col-form-label">Model</label>
                    <input type="text" class="form-control" name="itemModel" id="itemModel" required>
                </div>
                <div class="form-group col-lg-4">
                    <label for="itemStatus" class="col-form-label">Status</label>
                    <select class="form-control" name="itemStatus" id="itemStatus" required>
                        <option>Choose..</option>
                        <option value="1">Brand New</option>
                        <option value="0">Used</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-2">
                    <label for="itemYear" class="col-form-label">Year</label>
                    <input type="text" class="form-control" name="itemYear" id="itemYear" required>
                </div>
                <div class="form-group col-lg-3">
                    <label for="itemSeries" class="col-form-label">Series</label>
                    <input type="text" class="form-control" name="itemSeries" id="itemSeries" required>
                </div>
                <div class="form-group col-lg-2">
                    <label for="itemQuantity" class="col-form-label">Quantity</label>
                    <input type="text" class="form-control" name="itemQuantity" id="itemQuantity" required>
                </div>
                <div class="form-group col-lg-2">
                    <label for="itemPrice" class="col-form-label">Price (each)</label>
                    <input type="text" class="form-control" name="itemPrice" id="itemPrice" required>
                </div>
                <div class="form-group col-lg-3">
                    <label for="itemRegistration" class="col-form-label">Registration #</label>
                    <input type="text" class="form-control" name="itemRegistration" id="itemRegistration" required>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="form-group col-lg-6">
                   <button type="submit" name="submit" value="submit" class="btn btn-blue btn-block">Add</button>
                </div>
        </form>
                <div class="form-group col-lg-6">
                    <a href="inventory.php" role="button" class="btn btn-danger btn-block">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>