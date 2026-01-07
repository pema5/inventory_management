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


if (isset($_POST['submit'])) {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    
    $sql = "SELECT * FROM user WHERE username = '$inputUsername'";
    $result = mysqli_query($conn, $sql);

  
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        
        if ($inputPassword == $row['password']) {
            $_SESSION['username'] = $inputUsername;
            header("Location: admin_panel.php"); 
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }
}


mysqli_close($conn);
?>
