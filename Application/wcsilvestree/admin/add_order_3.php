<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php
    if(isset($_GET["id"])) {
        $order_id = $_GET["id"];
        $query  = "SELECT SUM(total_price) AS total_amount FROM ";
        $query .= "ordered_items WHERE order_number = {$order_id}";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $sum = $row["total_amount"];
        if($row) {
            //check outstanding balance
            $get_credit  = "SELECT * FROM orders ";
            $get_credit .= "WHERE id = {$order_id}";
            $query_credit = mysqli_query($connection, $get_credit);
            $go_credit = mysqli_fetch_assoc($query_credit);
                $credit = $go_credit["outstanding_balance"];

        }
    }
?>

<?php include("../layouts/header.php"); ?>
<?php include("../layouts/nav.php"); ?>

<!-- Main Content - START -->
<div class="container-fluid push-md"> <!-- container -->

    <div class="row ">
        <div class="col-lg-6">
            <h1>Add New Order</h1>
        </div>
    </div>
    <hr />

    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Step 3: &nbsp;Confirm Order</h3>
                    <p>Orders with outstanding balance needs to be approved by the admin.</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                    <div class="col">
                        <h3>Items selected</h3>
                    </div>
                    <div class="col text-right;">
                        <div id="totaAmount" class="text-right">
                            <h3>Total Amount: <?php echo number_format($sum,2); ?></h3>
                        </div>
                    </div>
                    </div class="row">
                    
                        <table class="table table-striped table-sm">
                            <thead class="thead-blue">
                                <tr>
                                    <th>Item #</th>
                                    <th>Name</th>
                                    <th>Price (each)</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                        <tbody>

                            <?php

                            $query2  = "SELECT *  ";
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

                            echo "<tr>";
                            echo "<td class=\"align-middle\">";
                            echo $item2["item_number"];
                            echo "</td>";
                            echo "<td class=\"align-middle\">";
                            echo htmlentities($item2["item_name"]);
                            echo "</td>";
                            echo "<td class=\"align-middle\">";
                            echo number_format($item2["item_price"],2);
                            echo "</td>";
                            echo "<td class=\"align-middle\">";
                            echo $item2["item_quantity"];
                            echo "</td>";
                            echo "<td class=\"align-middle\">";
                            echo htmlentities($item2["status"]);
                            echo "</td>";
                            echo "<td class=\"align-middle text-center\" class=\"total\">";
                            echo number_format($item2["total_price"],2);
                            echo "</td>";
                            echo "</tr>";

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



        <!-- RIGHT SIDE / BILLING INFO - START -->
        <div class="col-lg-4">
            <div class="card">
                <h3 class="card-header text-center">Billing Info</h3>
                <div class="card-body mt-4 mb-5">
                    
                    <?php
                    $get_order  = "SELECT * FROM orders ";
                    $get_order .= "WHERE id = {$order_id}";
                    $run = mysqli_query($connection, $get_order);
                    $go = mysqli_fetch_assoc($run);
                    $x = $go["id"];
                    $y = $go["ordered_by"];
                    $z = $go["amount_paid"];
                    ?>

                    <form action="../functions/add_order_3_admin.php?id=<?php echo $x; ?>" method="POST">
                    <h4 class="card-title">Order Number</h4>
                    <input type="text" class="form-control" name="orderNumber" id="orderNumber" value="<?php echo $x; ?>" readonly>

                    <h4 class="card-title mt-4">Ordered by</h4>
                    <input type="text" class="form-control" name="orderedBy" id="orderedBy" value="<?php echo $y ?>" readonly>

                    <h4 class="card-title mt-4">Outstanding Balance</h4>
                    <input type="text" class="form-control" name="outstandingBalance" id="outstandingBalance" value="<?php echo number_format($credit,2); ?>" readonly>

                    <h4 class="card-title mt-4">Amount Paid</h4>
                    <?php echo message(); ?>
                    <input type="text" class="form-control" name="amountPaid" id="amountPaid" placeholder="Previous payment: <?php echo number_format($z,2); ?>"required>
                    <small id="emailHelp" class="form-text text-muted">Outstandng balance automatically computed.</small>

                    <!-- for total amount -->
                    <input type="hidden" name="totalAmount" id="totalAmount" value="<?php echo $sum; ?>">

                    <div class="form-group row pt-4">
                        <div class="col-sm-6">
                        <a href="add_order_2.php?id=<?php echo $x; ?>" role="button" class="btn btn-danger btn-block"><i class="fa fa-angle-left mr-2" aria-hidden="true"></i> Go Back</a>
                        </div>

                        <div class="col-sm-6">
                        <button type="submit" name="submit" id="confirm" class="btn btn-primary btn-block">Confirm <i class="fa fa-angle-right ml-2" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
        <!-- RIGHT SIDE / BILLING INFO - START -->

        </div>
    </div>
       
    
</div> <!-- container -->
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>