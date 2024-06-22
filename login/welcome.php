<?php
session_start();
if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true)
{
    header("location:login.php");
}
?>
<h1><?php echo "welcome ".$_SESSION['email'] ?></h1>
<p>Hello <?php echo "welcome ".$_SESSION['email'] ?>.This page was built for alpha testing of login page of DQ hackathon </p>
<p>for more information you can check me out at <a href="https://priyanshukumaranand.github.io/Portfolio/" target=",_blank">https://priyanshukumaranand.github.io/Portfolio/</a> </p>
<button onclick="logout()">LOGOUT
</button>
<script>
    function logout() {
        location.replace("logout.php");
    }
</script>