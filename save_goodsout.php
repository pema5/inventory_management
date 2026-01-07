<?php
$conn = new mysqli("localhost", "root", "root", "try");

if ($conn->connect_error) {
    die("Connection failed");
}

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$quantity = (int)$_POST['product_quantity'];
$unit = $_POST['product_unit'];
$date = $_POST['date'];

// get current stock
$stmt = $conn->prepare(
    "SELECT product_stock FROM productentry WHERE product_code = ?"
);
$stmt->bind_param("s", $product_id);
$stmt->execute();
$stmt->bind_result($stock);
$stmt->fetch();
$stmt->close();

if ($stock < $quantity) {
    die("Insufficient stock");
}

// insert goods out
$stmt = $conn->prepare(
    "INSERT INTO goodsout (product_id, product_name, quantity, unit, out_date)
     VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("ssiss", $product_id, $product_name, $quantity, $unit, $date);
$stmt->execute();
$stmt->close();

// update stock
$new_stock = $stock - $quantity;
$stmt = $conn->prepare(
    "UPDATE productentry SET product_stock = ? WHERE product_code = ?"
);
$stmt->bind_param("is", $new_stock, $product_id);
$stmt->execute();
$stmt->close();

header("Location: goodsout.php");
exit;
?>
