<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:welcome.php");
    exit;
}
require_once "config.php";
$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['email'])) || empty(trim($_POST['password']))) {
        $err = "please enter email + passworrd";
    } else {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }
    if (empty($err)) {
        $sql = "SELECT id,username,email,password FROM users where email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username, $email, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;
                        header("location:welcome.php");
                    }
                }
            }

        }
    }
}

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Overlay Login Form</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="assets/css/Overlay-Login-Form.css">
</head>

<body>
    <section>
        <div class="section-bg-overlay">
            <div class="form-box">
                <div class="form-value">
                    <form action="" method="post">
                        <div class="inputbox"><input type="email" name="email" required=""><label class="form-label"
                                for="">Email</label></div>
                        <div class="inputbox"><input type="password" name="password" required=""><label
                                class="form-label" for="">Password</label></div>
                        <div class="forget"><label class="form-label" for=""><input type="checkbox">Remember&nbsp; |
                                &nbsp;<a href="forget_pass.php" target="_blank">Forgot Password</a></label>
                        </div>
                        <button onclick="myFunction()">LOGIN</button>
                        <!-- <script>
                            function myFunction() {
                                location.replace("https://www.youtube.com")
                            }
                        </script> -->
                        <div class="register">
                            <p><br><a href="register.php" target="_blank"><span style="color: rgb(232, 234, 237) ">Don't
                                        have an account?</span><br><br></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>