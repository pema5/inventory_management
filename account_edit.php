<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("Unauthorized access!");
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $check_email_sql = "SELECT id FROM customers WHERE email = '$email' AND id != $user_id";
    $result = mysqli_query($conn, $check_email_sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "<div style='color: red;'>The email address is already in use by another account.</div>";
    } else {
        $sql = "UPDATE customers SET 
                first_name='$first_name', 
                last_name='$last_name', 
                email='$email', 
                phone='$phone', 
                address='$address' 
                WHERE id = $user_id";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = "<div style='color: green;'>Your account is updated successfully.</div>";
        } else {
            $_SESSION['message'] = "<div style='color: red;'>Error updating account: " . mysqli_error($conn) . "</div>";
        }
    }

    header("Location: account_edit.php");
    exit();
}

mysqli_close($conn);
?>
