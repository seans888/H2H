<?php require_once("../functions/sessions.php"); ?>
<?php require_once("../functions/redirect_to.php"); ?>
<?php require_once("../functions/db_connect.php"); ?>
<?php require_once("../functions/password_encrypt.php"); ?>
<?php require_once("../functions/escape.php"); ?>

<?php
if(isset($_POST["submit"])) {
    $username = escape($_POST["username"]);
    $password = $_POST["password"];
    $error_catch = false;

    $query  = "SELECT * FROM ";
    $query .= "admin_accounts ";
    $query .= "WHERE username = '{$username}' ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    $user = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if($count != 0) {
        if($user["approved"] != 0) {
            if($username == $user["username"] && password_check($password, $user["password"])) {
                $_SESSION["logged_id"] = $user["id"];
                $_SESSION["logged_username"] = $user["username"];
                $_SESSION["logged_first_name"] = $user["first_name"];
                redirect_to("index.php");
            } else {
                $_SESSION["error"] = "Username/Password does not match!";
            }
        } else {
            $_SESSION["error"] = "Your account is not yet active.";
        }
    } else {
        $_SESSION["error"] = "Account does not exists!";
    }

}

?>

<?php include("../layouts/header.php"); ?>
<div class="wrapper">
    <div class="wrapper-inner">
        <div class="cover-container">
            <div class="inner cover">
                <?php echo error(); ?>
                <div class="card mx-auto" style="max-width: 480px" id="login-box">
                    <img class="card-img-top" src="../img/1.png" alt="Logo">
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Enter username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-blue btn-block mt-5">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../layouts/footer.php"); ?>