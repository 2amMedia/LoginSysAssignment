<?php
$dBServername = "localhost";
$dBUsername = "root";
$dBPassword = "mysql";
$dBName = "loginsystemtut";

// We are going to create the connection here. 
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Here we check the connection.
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
