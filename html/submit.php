<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productCode = $_POST['productcode'];
    $productName = $_POST['productname'];
    $productType = $_POST['producttype'];
    $productUnit = $_POST['productunit'];
    $salesRate = $_POST['salesrate'];
    
    $imageName = "";
    if (!empty($_FILES['uploadphoto']['name'])) {
        $imageName = basename($_FILES["uploadphoto"]["name"]);
        $targetDir = "uploads/";
        $targetFilePath = $targetDir . $imageName;
        
        if (!move_uploaded_file($_FILES["uploadphoto"]["tmp_name"], $targetFilePath)) {
            die("Error uploading file.");
        }
    }

    $sql = "INSERT INTO productentry (product_code, product_name, product_type, product_unit, sales_rate, image)
            VALUES ('$productCode', '$productName', '$productType', '$productUnit', '$salesRate', '$imageName')";

    if ($conn->query($sql) === TRUE) {
        header("Location: Viewproduct.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
