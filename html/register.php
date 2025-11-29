<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$pass = $_POST['password'];
$confirm_pass = $_POST['confirm_password'];

if ($pass !== $confirm_pass) {
    die("Passwords do not match!");
}

$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

$query = "INSERT INTO users (name, email, phone, address, gender, password) VALUES ('$name', '$email', '$phone', '$address', '$gender', '$hashed_password')";

if (mysqli_query($conn, $query)) {
    echo "Registration successful!";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
