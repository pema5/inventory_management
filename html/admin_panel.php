<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "illegal access";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$sql = "SELECT product_name, product_unit, sales_rate FROM productentry";
$result = mysqli_query($conn, $sql);

$total_stock = 0;
$total_stock_value = 0;
$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $stock_value = $row["product_unit"] * $row["sales_rate"];

    $products[] = [
        "name" => $row["product_name"],
        "stock" => $row["product_unit"],
        "price" => $row["sales_rate"],
        "value" => $stock_value
    ];

    $total_stock += $row["product_unit"];
    $total_stock_value += $stock_value;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.navbar {
    background-color: #6a0dad;
    color: white;
    padding: 15px;
    text-align: center;
    position: relative;
}

.navbar h4 {
    margin: 0;
}

.logout {
    position: absolute;
    right: 20px;
    top: 15px;
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.logout:hover {
    color: #ffdd00;
}

/* ===== CARD CONTAINER FIX ===== */
.container {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    padding: 30px;
    max-width: 1200px;
    margin: auto;
}

.box {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    text-align: center;
    transition: 0.3s;
}

.box:hover {
    transform: scale(1.05);
}

.box img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
}

.box h1 {
    font-size: 20px;
    margin: 10px 0;
    color: #333;
}

.box a {
    text-decoration: none;
    font-weight: bold;
    color: red;
}

.box a:hover {
    color: #0056b3;
}

/* STOCK SUMMARY */
.stock-summary {
    max-width: 900px;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

.stock-summary h2 {
    text-align: center;
}

.summary {
    padding: 10px;
    background: #f8f8f8;
    border-radius: 5px;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

th {
    background: blueviolet;
    color: white;
}

.footer {
    background-color: #333;
    color: #ddd;
    text-align: center;
    padding: 10px;
    margin-top: 20px;
}
</style>
</head>

<body>

<div class="navbar">
    <h4><marquee>Welcome to Admin Panel</marquee></h4>
    <a class="logout" href="logout.php">Log Out</a>
</div>

<div class="container">

    <div class="box">
        <img src="bg.jpg">
        <h1>New Product</h1>
        <p><a href="productEntry.html">Entry Product</a></p>
        <p><a href="viewProduct.php">View Product</a></p>
        <p><a href="goodsout.php">Goods Out</a></p>
        <p><a href="productsLogs.php">Products Log</a></p>
    </div>

    <div class="box">
        <img src="employee_registration.jpg">
        <h1>Employee</h1>
        <p><a href="registrationformForEmployee.html">Register Employee</a></p>
        <p><a href="ViewEmployee.php">View Employee</a></p>
    </div>

    <div class="box">
        <img src="sales.jpg">
        <h1>Sales</h1>
        <p><a href="salesHistory.php">Sales History</a></p>
    </div>

</div>

<div class="stock-summary">
    <h2>Stock Overview</h2>
    <div class="summary">
        <strong>Total Stock Value:</strong>
        Rs. <?php echo number_format($total_stock_value,2); ?>
    </div>

    <table>
        <tr>
            <th>Item</th>
            <th>Remaining Stock</th>
            <th>Sales Price</th>
            <th>Stock Value</th>
        </tr>

        <?php foreach ($products as $p) { ?>
        <tr>
            <td><?php echo $p["name"]; ?></td>
            <td><?php echo $p["stock"]; ?></td>
            <td>Rs. <?php echo number_format($p["price"],2); ?></td>
            <td>Rs. <?php echo number_format($p["value"],2); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<div class="footer">
    &copy; 2024 Admin Panel
</div>

</body>
</html>
