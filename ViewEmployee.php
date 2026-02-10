<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT FullName, DOB, Gender, PhoneNumber, Address, WorkExperience FROM employeeregistration";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; margin: 20px 0; color: black;'>";  
    echo "<thead><tr style='background-color: #8A2BE2; color: black;'><th>Full Name</th><th>DOB</th><th>Gender</th><th>Phone</th><th>Address</th><th>Work Experience</th></tr></thead><tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['FullName'] . "</td>";
        echo "<td>" . $row['DOB'] . "</td>";
        echo "<td>" . $row['Gender'] . "</td>";
        echo "<td>" . $row['PhoneNumber'] . "</td>";
        echo "<td>" . $row['Address'] . "</td>";
        echo "<td>" . $row['WorkExperience'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p style='color: #8A2BE2;'>No employees found.</p>";  
}


mysqli_close($conn);
?>
