<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "my_database"; // Replace with your DB name

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}
?>
