<?php
/*
*/
define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','login');
// define('DB_SERVER','');
//connecting
$conn=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);
//chqeck
if($conn==false){
    dir('Error:cant connect to server');
}
?>