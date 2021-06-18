<?php


$host = "localhost"; 
$user = "if20";
$password = "if20";
$dbname = "if20_pille_suvepraktika";


$con = new mysqli($host, $user, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

mysqli_select_db($con,'if20_pille_suvepraktika');

?>