<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $fullName = $_POST['fname'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $phoneNumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $workExperience = $_POST['workexperience'];

    $sql = "INSERT INTO employeeregistration (FullName, DOB, Password, Gender, PhoneNumber, Address, WorkExperience) 
            VALUES ('$fullName', '$dob', '$password', '$gender', '$phoneNumber', '$address', '$workExperience')";

    if (mysqli_query($conn, $sql)) {
        echo "New employee record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>
