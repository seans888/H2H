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
            <h1>Add New User Account</h1>
          
        </div>
    </div>
    <hr />
    <div class="row justify-content-center">

    <div class="col-lg-6">
        <form action="../functions/add_user_admin.php" method="POST" id="userAccounts">
            <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="firstName" class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-3 col-form-label">Last name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="landline" class="col-sm-3 col-form-label">Landline</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="landline" id="landline" placeholder="Landline Number" required>
                </div>
            </div>
            <div class="form-group row pt-4">
                <div class="col-sm-6">
                    <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Create account</button>
                </div>

                <div class="col-sm-6">
                    <a href="user_accounts.php" role="button" class="btn btn-danger btn-block"><i class="fa fa-times mr-2" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
        </form>
    </div>








    </div>
</div>
<!-- Main Content - END -->
<?php include("../layouts/footer.php"); ?>