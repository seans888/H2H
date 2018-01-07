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
        $query .= "inventory WHERE id = {$current_id}";
        $result = mysqli_query($connection, $query);

        if(!$result) {
            echo mysqli_error($connection);
        }

        while($item = mysqli_fetch_assoc($result)) {
            if($item["status"] == 1) {
                $item["status"] = "Brand New";
            } else {
                $item["status"] = "Used";
            }

            $id = $item["id"];
            $item_name = $item["item_name"];
            $item_model = $item["item_model"];
            $item_year = $item["item_year"];
            $item_series = $item["item_series"];
            $item_quantity = $item["item_quantity"];
            $item_price = $item["item_price"];
            $item_status = $item["status"];
            $reg_no = $item["reg_no"];
            $processed_by = $item["processed_by"];
            $date_time = $item["date_time"];
        } 

    } else {
        redirect_to("inventory.php");
    }
?>


<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>




<!-- Main Content - START -->
<div class="container push-md">
    <div class="row no-gutters">
        <?php echo message(); ?>
        <div class="col-lg-12">
            <h1>Edit Item</h1>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
        <form action="../functions/edit_item_admin.php" method="POST" id="editItem">
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="itemNumber" class="col-form-label" disabled>Item #</label>
                    <input type="text" class="form-control" name="itemNumber" id="itemNumber" value="<?php echo $id; ?>" readonly>
                </div>
                <div class="form-group col-lg-4">
                    <label for="itemProcessedBy" class="col-form-label">Processed by</label>
                    <input type="text" class="form-control" name="itemProcessedBy" id="itemProcessedBy" value="<?php echo $processed_by; ?>" readonly>
                </div>
                <div class="form-group col-lg-4">
                    <label for="itemDateTime" class="col-form-label">Date/Time</label>
                    <input type="text" class="form-control" name="itemDateTime" id="itemDateTime" value="<?php echo $date_time; ?>" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-4">
                    <label for="itemName" class="col-form-label">Item Name</label>
                    <input type="text" class="form-control" name="itemName" id="itemName" value="<?php echo $item_name; ?>" required>
                </div>
                <div class="form-group col-lg-4">
                    <label for="itemModel" class="col-form-label">Model</label>
                    <input type="text" class="form-control" name="itemModel" id="itemModel" value="<?php echo $item_model; ?>" required>
                </div>
                <div class="form-group col-lg-4">
                    <label for="itemStatus" class="col-form-label">Status</label>
                    <select class="form-control" name="itemStatus" id="itemStatus" required>
                        <option value="1" <?php if($item_status == "Brand New") { echo "selected"; } ?>>Brand New</option>
                        <option value="0" <?php if($item_status == "Used") { echo "selected"; } ?>>Used</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-2">
                    <label for="itemYear" class="col-form-label">Year</label>
                    <input type="text" class="form-control" name="itemYear" id="itemYear" value="<?php echo $item_year; ?>" required>
                </div>
                <div class="form-group col-lg-3">
                    <label for="itemSeries" class="col-form-label">Series</label>
                    <input type="text" class="form-control" name="itemSeries" id="itemSeries" value="<?php echo $item_series; ?>" required>
                </div>
                <div class="form-group col-lg-2">
                    <label for="itemQuantity" class="col-form-label">Quantity</label>
                    <input type="text" class="form-control" name="itemQuantity" id="itemQuantity" value="<?php echo $item_quantity; ?>" required>
                </div>
                <div class="form-group col-lg-2">
                    <label for="itemPrice" class="col-form-label">Price (each)</label>
                    <input type="text" class="form-control" name="itemPrice" id="itemPrice" value="<?php echo $item_price; ?>" required>
                </div>
                <div class="form-group col-lg-3">
                    <label for="itemRegistration" class="col-form-label">Registration #</label>
                    <input type="text" class="form-control" name="itemRegistration" id="itemRegistration" value="<?php echo $reg_no; ?>" required>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="form-group col-lg-4">
                   <button type="submit" name="submit" value="submit" class="btn btn-success btn-block">Update</button>
                </div>
        </form>
                <div class="form-group col-lg-4">
                    <a href="../functions/delete_item.php?id=<?php echo $id; ?>" id="delete" role="button" class="btn btn-danger btn-block">Delete</a>
                </div>
                <div class="form-group col-lg-4">
                    <a href="inventory.php" role="button" class="btn btn-blue btn-block">Cancel</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>