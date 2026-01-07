<?php
$host = 'localhost';
$dbname = 'my_database';
$username = 'root';
$password = 'root';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT first_name, last_name, email, phone, address FROM customers";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 100%; margin: 20px 0; color: black;'>";  
    echo "<thead><tr style='background-color: #8A2BE2; color: black;'><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th></tr></thead><tbody>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['first_name'] . "</td>";
        echo "<td>" . $row['last_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p style='color: #8A2BE2;'>No customers found.</p>";  // BlueViolet color for "No customers found"
}

mysqli_close($conn);
?>
