<?php
$insert = false;
if(isset($_POST['name'])){ 
    $server = "localhost";
    $username="root";
    $password="";

    $con = mysqli_connect($server, $username, $password);
    
    if(!$con){
        die("connection failed due to". mysqli_connect_error());
    }
    
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $other = $_POST['other'];
    $sql = "INSERT INTO `trip`.`trip` (`name`,`age`, `gender`, `phone`, `other`, `date`) VALUES ('$name', '$age', '$gender', '$phone', '$other', current_timestamp());";
    //echo $sql;

    if($con->query($sql) == true){
    //echo "Successfully insreted";
        $insert =true;
    }
    else{
        echo "ERROR:$sql <br> $con->error";
     }
     $con->close();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">

    <title>Welcome to CRCTC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&family=Nunito+Sans:wght@200&display=swap"
        rel="stylesheet">
</head>

<body>
    <img class="cuba" src="view-Havana.webp" alt="Cuba">
    <div class="container">
        <h3 align="center">WELCOME TO CRCTC TRAVEL FORM</h3>
        <p align="center">Enter your details to confirm</p>
        <!-- <p1 class="submitted">Thanks for joining trip for cuba</p1> --> 
        <?php 
        if($insert == true){
            echo "<p class='submitMsg'>Thanks for joining trip for cuba</p>";
            }
        ?>
        <form action="index.php" method="post">
        <input type="text" name="name" id="name" placeholder="Enter your name">
        <input type="number" name="age" id="age" placeholder="Enter your age">
        <input type="text" name="gender" id="gender" placeholder="Enter your gender">
        <input type="number" name="phone" id="phone" placeholder="Enter your phone number">
        <textarea name="other" id="other" cols="30" rows="10" placeholder="Enter any other details"></textarea>
        <button class="btn">SUBMIT</button>
        </form>
    </div>
    <script src="index.js"></script>
</body>

</html>

