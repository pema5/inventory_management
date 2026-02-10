<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['code'])) {
    die("Invalid request");
}

$productCode = $_GET['code'];

/* 1️⃣ Get image filename */
$stmt = $conn->prepare(
    "SELECT uploadphoto FROM productentry WHERE productcode = ?"
);
$stmt->bind_param("s", $productCode);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $photo = $row['uploadphoto'];

    /* 2️⃣ Delete image file */
    if (!empty($photo) && file_exists("uploads/" . $photo)) {
        unlink("uploads/" . $photo);
    }

    /* 3️⃣ Delete database record */
    $deleteStmt = $conn->prepare(
        "DELETE FROM productentry WHERE productcode = ?"
    );
    $deleteStmt->bind_param("s", $productCode);
    $deleteStmt->execute();
    $deleteStmt->close();
}

$stmt->close();
$conn->close();

/* 4️⃣ Redirect ONCE */
header("Location: viewProduct.php");
exit();
?>
