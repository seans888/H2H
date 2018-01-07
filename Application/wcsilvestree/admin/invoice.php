<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/logged_in.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php
    // get order info
    if(isset($_GET["id"])) {
        $invoice_id = $_GET["id"];
    }

    $get_sales = "SELECT * FROM sales where id = {$invoice_id}";
    $query_sales = mysqli_query($connection, $get_sales);
    $sales = mysqli_fetch_assoc($query_sales);
        $sales_id = $sales["id"];
        $sales_order = $sales["order_id"];
        $sales_customer = strtolower($sales["customer_id"]);
        $sales_total_amount = $sales["total_amount"];
        $sales_balance = $sales["outstanding_balance"];
        $sales_status = $sales["status"];
        $sales_validator = $sales["validated_by"];
        $sales_date = $sales["date_time"];


    if($query_sales) {
        //get customer info
        $get_customer  = "SELECT * FROM customers_list ";
        $get_customer .= "WHERE CONCAT( first_name, ' ', last_name) LIKE '{$sales_customer}'";
        $query_customer = mysqli_query($connection, $get_customer);
        $customer = mysqli_fetch_assoc($query_customer);
            $customer_name = ucfirst($customer["first_name"]) . ' ' . ucfirst($customer["last_name"]);
            $customer_address = $customer["home_address"];
            $customer_company = $customer["company_name"];
            $customer_comp_address = $customer["company_address"];
            $customer_mobile = $customer["mobile"];
            $customer_landline = $customer["landline"];
            $customer_email = $customer["email"];

    }

    //get ordered items
    



?>





<?php include("../layouts/header.php"); ?>


<!-- main -->
<div class="container mt-5 p-5" id="invoice"> <!-- container -->
    <div class="row">
        <div class="col-lg-3">
            <img class="card-img-top" src="../img/logo.svg" alt="Logo">
        </div>
        <div class="col-lg-5 text-right">
            <h3>02-930-7070</h3>
            <h3>bagoluma@gmail.com</h3>
            <h3>www.bagoluma.com</h3>
        </div>
        <div class="col-lg-4 text-right">
            <h3>90 Goldfield St.</h3>
            <h3>Quezon City, PH</h3>
            <h3>1123</h3>
        </div>
    </div>

    <hr/>

    <div class="row mt-5">
        <div class="col-lg-5">
           <p class="lead text-muted">Billed To</p>
           <p><?php echo $customer_name; ?><br/>
              <?php echo $customer_address; ?></p>
        </div>
        <div class="col-lg-3">
            <p class="lead text-muted">Invoice Number</p>
            <p><?php echo $sales_id; ?></p>
            <p class="lead text-muted">Invoice Number</p>
            <p><?php echo $sales_date; ?></p>
        </div>
        <div class="col-lg-4 text-right">
        <p class="lead text-muted">Invoice Total</p>
        <h1>PHP <?php echo number_format($sales_total_amount,2); ?><h1>
        </div>
    </div>


    <hr/>

    <div class="row mt-5">
        <div class="col-lg-12">
            <table class="table table-striped table-sm">
                <thead class="thead-blue">
                    <tr>
                        <th>Item #</th>
                        <th>Item Name</th>
                        <th>Item Quantity</th>
                        <th>Item price (each)</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>

                
                <?php
           
           
              $query  = "SELECT * ";
              $query .= "FROM ordered_items ";
              $query .= "WHERE order_number = {$sales_order}";
              $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) != 0) {
              while($item = mysqli_fetch_assoc($result)) {
                if($item["status"] == 1) {
                    $item["status"] = "Brand New";
                } else {
                    $item["status"] = "Used";
                }
                
                echo "<tr>";
                echo "<td class=\"align-middle\">";
                echo $item["id"];
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo htmlentities($item["item_name"]);
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo htmlentities($item["item_quantity"]);
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo number_format($item["item_price"],2);
                echo "</td>";
                echo "<td class=\"align-middle\">";
                echo number_format($item["total_price"],2);
                echo "</td>";
                echo "</tr>";
              }
            }
            else {
              echo '
              <tr class="text-center">
                <td colspan="12 " class="pt-5 pb-5"><h2>No items found</h2></td>
              </tr>
              ';
            }
            mysqli_free_result($result);
         ?>



                </tbody>
            </table>
        </div>
    </div>

</div> <!-- container -->

<?php include("../layouts/footer.php"); ?>