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
            <h1>Add New Schedule</h1>
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">

    <div class="col-lg-7">
        <form action="../functions/add_schedule_admin.php" method="POST" id="schedRecord">
        
            <div class="form-group row">
                <label for="time" class="col-sm-3 col-form-label">Time</label>
                <div class="col-sm-9">
                    <input type="time" class="form-control" name="time" id="time" placeholder="Time" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="date" id="date" placeholder="Date" required>
                </div>
            </div>

        
            <div class="form-group row">
                <label for="employeeID" class="col-sm-3 col-form-label">Employee ID</label>
                <div class="col-sm-9">
                    <input type="drop-down" class="form-control" name="employeeID" id="employeeID" placeholder="Employee ID" required>
                 
                </div>
            </div>
            
            <div class="form-group row">
                <label for="facilityID" class="col-sm-3 col-form-label">Facility ID</label>
                <div class="col-sm-9">        
                     <input type="number" class="form-control" name="facilityID" id="facilityID" placeholder="Facility ID" required>
                </div>
            </div>
           
          
            <div class="form-group row pt-4">
                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Create record</button>
                </div>

                <div class="col-sm-6">
                    <a href="schedule.php" role="button" class="btn btn-danger btn-block"><i class="fa fa-times mr-2" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>

        <?php 

            mysql_connect('localhost', 'root', '');
            mysql_select_db('h2h_db');

            $sql = "SELECT id FROM facility";
            $result = mysql_query($sql);

            echo "<select id='sub1'>";

            while ($row = mysql_fetch_array($result)) {
                echo "<option value '" . $row['id'] ."'>" . $row['id'] ."</option>";
            }

            echo "</select>"
 ?>


    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>