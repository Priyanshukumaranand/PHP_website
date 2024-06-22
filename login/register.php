<?php
require_once "config.php";
$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty(trim($_POST["username"]))) {
        echo '<script>alert("Your stuff here")</script>';
        $username_er = "cant be blank";
    } else {
        $sql = "SELECT ID FROM users WHERE username=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            //set value of param
            $param_username = trim($_POST['username']);
            //try to execute the statement 
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    echo '<script>alert("Your stuff here")</script>';
                    $username_err = "theis username already exist";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo '<script>alert("Your stuff here")</script>';
                ;
            }
        }

    }
    if (empty(trim($_POST['email']))) {
        echo '<script>alert("Your stuff here")</script>';
        $email_err = "email cannot be blank";
    } else {
        $sql = "SELECT ID FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            //set value of param
            $param_username = trim($_POST['email']);
            //try to execute the statement 
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    echo '<script>alert("Your stuff here")</script>';
                    $email_err = "theis email already exist";
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo '<script>alert("Your stuff here")</script>';
                ;
            }
        }

    }
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot less than 5";
    } else {
        $password = trim($_POST['password']);
    }
    if (trim($_POST['confirm_password']) != trim($_POST['confirm_password'])) {
        echo '<script>alert("Your stuff here")</script>';
        $password_err = "password should match ";
    }
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users(username,email,password) VALUES (?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            // try to execute the query
            if (mysqli_stmt_execute($stmt)) {
                header("location:login.php");
            } else {
                echo '<script>alert("Your stuff here")</script>';
                echo "something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
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
                        <div class="inputbox">
                            <input type="name" name="username" required=""><label class="form-label" for="">Name</label>
                        </div>
                        <div class="inputbox">
                            <input type="email" name="email" required=""><label class="form-label" for="">Email</label>
                        </div>
                        <div class="inputbox">
                            <input type="password" name="password" required=""><label class="form-label"
                                for="">Password</label>
                        </div>
                        <div class="inputbox">
                            <input type="password" name="confirm_password" required=""><label class="form-label"
                                for="">Confirm Password</label>
                        </div>
                        <!-- <div class="forget"><label class="form-label" for=""><input type="checkbox">Remember&nbsp; | &nbsp;<a href="https://www.youtube.com" target="_blank">Forgot Password</a></label></div> -->
                        <button onclick="myFunction()">SUBMIT</button>
                        <script>
                            function myFunction() {
                                //location.replace("login.php");
                                alert(success);
                            }
                        </script>
                        <!-- <div class="register">
                            <p><br><a href="https://www.youtube.com" target="_blank"><span style="color: rgb(232, 234, 237) ">Don't have an account?</span><br><br></p>
                        </div> -->
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