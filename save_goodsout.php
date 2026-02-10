<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $productcode = intval($_POST['productcode']);
    $quantity = intval($_POST['productunit']);
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
    $date_time = $_POST['date_time'];

    // 1️⃣ Get current stock
    $stmt = $conn->prepare("SELECT productunit FROM productentry WHERE productcode = ?");
    if (!$stmt) die("Prepare failed: " . $conn->error);
    $stmt->bind_param("i", $productcode);
    $stmt->execute();
    $stmt->bind_result($stock);
    $stmt->fetch();
    $stmt->close();

    if (!isset($stock)) {
        die("Error: Product code not found.");
    }

    if ($stock < $quantity) {
        die("Error: Insufficient stock. Current stock: $stock");
    }

    // 2️⃣ Insert into goodsout (matches your table columns)
    $stmt = $conn->prepare(
        "INSERT INTO goodsout (productcode, customer_name, customer_phone, quantity, date_time)
        VALUES (?, ?, ?, ?, ?)"
    );
    if (!$stmt) die("Prepare failed: " . $conn->error);
    $stmt->bind_param("issis", $productcode, $customer_name, $customer_phone, $quantity, $date_time);
    if (!$stmt->execute()) die("Insert failed: " . $stmt->error);
    $stmt->close();

    // 3️⃣ Update stock in productentry
    $new_stock = $stock - $quantity;
    $stmt = $conn->prepare("UPDATE productentry SET productunit = ? WHERE productcode = ?");
    if (!$stmt) die("Prepare failed: " . $conn->error);
    $stmt->bind_param("ii", $new_stock, $productcode);
    if (!$stmt->execute()) die("Update failed: " . $stmt->error);
    $stmt->close();

    // 4️⃣ Redirect back with success
    header("Location: goodsout.php?success=1");
    exit;
}
?>
