<?php
$hostname = "127.0.0.1";
$username = "ecpi_user";
$password = "Password1";
$dbname   = "sdc310l_project";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>