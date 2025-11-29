<?php
$host = 'localhost';
$dbname = 'my_database';
$username = 'root';
$password = 'root';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $action = $_POST['action'];

    if ($action === 'Register') {
        $sql = "INSERT INTO customers (first_name, last_name, email, password, phone, address) 
                VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', '$address')";

        if (mysqli_query($conn, $sql)) {
            echo "Registration successful!";
            header("Location: Customerlogin.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif ($action === 'Edit') {
        header("Location: account_edit.html");
        exit();
    } else {
        echo "Invalid action.";
    }
}

mysqli_close($conn);
?>
