<?php
include "db.php";

$message = "";

// Handle Goods Out submission
if (isset($_POST['goodsout'])) {

    $code = intval($_POST['productcode']);
    $unit_out = intval($_POST['productunit']);

    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $customer_phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);

    $date_time = date("Y-m-d H:i:s");

    // GET CURRENT STOCK
    $res = mysqli_query($conn, "SELECT productunit FROM productentry WHERE productcode='$code'");

    if ($res && mysqli_num_rows($res) == 1) {

        $row = mysqli_fetch_assoc($res);
        $current_unit = intval($row['productunit']);

        if ($unit_out > 0 && $unit_out <= $current_unit) {

            $new_unit = $current_unit - $unit_out;

            // UPDATE STOCK
            mysqli_query(
                $conn,
                "UPDATE productentry 
                 SET productunit='$new_unit' 
                 WHERE productcode='$code'"
            );

            $message = "Goods Out successful! Stock updated.";

        } else {
            $message = "Invalid quantity. Not enough stock.";
        }

    } else {
        $message = "Product code not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Goods Out</title>

<style>
body {
    font-family: Arial;
    background:#f0f2f5;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.container {
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
    width:420px;
}
h2 {
    text-align:center;
    color:#4b0082;
}
label {
    display:block;
    margin-top:15px;
}
input, select {
    width:100%;
    padding:10px;
    margin-top:5px;
    border-radius:6px;
    border:1px solid #aaa;
}
input[readonly], select:disabled {
    background:#eee;
}
button {
    width:100%;
    padding:12px;
    margin-top:20px;
    background:#6a5acd;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}
button:hover {
    background:#483d8b;
}
.message {
    text-align:center;
    margin-bottom:10px;
    color:green;
}
</style>
</head>

<body>

<div class="container">
<h2>Goods Out Form</h2>

<?php if ($message) echo "<div class='message'>$message</div>"; ?>

<form method="POST">

    <label>Customer Name</label>
    <input type="text" name="customer_name" required>

    <label>Customer Phone</label>
    <input type="text" name="customer_phone" required>

    <label>Date & Time</label>
    <input type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>

    <label>Product Code</label>
    <input type="number" name="productcode" id="code" onkeyup="fetchProduct()" required>

    <label>Product Name</label>
    <select id="name" disabled></select>

    <label>Product Type</label>
    <select id="type" disabled></select>

    <label>Sales Rate</label>
    <select id="rate" disabled></select>

    <label>Quantity to Remove</label>
    <input type="number" name="productunit" min="1" required>

    <button type="submit" name="goodsout">Goods Out</button>

</form>
</div>

<script>
function fetchProduct() {
    let code = document.getElementById("code").value;
    if (code === "") return;

    fetch("fetch_product.php?code=" + code)
    .then(response => response.json())
    .then(data => {
        if (data) {
            document.getElementById("name").innerHTML =
                `<option>${data.productname}</option>`;
            document.getElementById("type").innerHTML =
                `<option>${data.producttype}</option>`;
            document.getElementById("rate").innerHTML =
                `<option>${data.salesrate}</option>`;
        } else {
            document.getElementById("name").innerHTML =
                `<option>Not found</option>`;
            document.getElementById("type").innerHTML =
                `<option>Not found</option>`;
            document.getElementById("rate").innerHTML =
                `<option>0</option>`;
        }
    });
}
</script>

</body>
</html>
