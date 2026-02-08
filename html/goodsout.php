<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Goods Out</title>
<style>
body {font-family: Arial; background:#f0f2f5; display:flex; justify-content:center; align-items:center; height:100vh;}
.container {background:white; padding:30px; border-radius:12px; box-shadow:0 8px 20px rgba(0,0,0,0.2); width:420px;}
h2 {text-align:center; color:#4b0082;}
label {display:block; margin-top:15px;}
input, select {width:100%; padding:10px; margin-top:5px; border-radius:6px; border:1px solid #aaa;}
input[readonly], select:disabled {background:#eee;}
button {width:100%; padding:12px; margin-top:20px; background:#6a5acd; color:white; border:none; border-radius:8px; cursor:pointer;}
button:hover {background:#483d8b;}
.message {text-align:center; margin-bottom:10px; color:green;}
</style>
</head>
<body>
<div class="container">
<h2>Goods Out Form</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="message">Goods Out successful! Stock updated and recorded.</div>
<?php endif; ?>

<form method="POST" action="save_goodsout.php">

    <label>Customer Name</label>
    <input type="text" name="customer_name" required>

    <label>Customer Phone</label>
    <input type="text" name="customer_phone" required>

    <label>Date & Time</label>
    <input type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly name="date_time">

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

    <button type="submit">Goods Out</button>
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
            document.getElementById("name").innerHTML = `<option>${data.productname}</option>`;
            document.getElementById("type").innerHTML = `<option>${data.producttype}</option>`;
            document.getElementById("rate").innerHTML = `<option>${data.salesrate}</option>`;
        } else {
            document.getElementById("name").innerHTML = `<option>Not found</option>`;
            document.getElementById("type").innerHTML = `<option>Not found</option>`;
            document.getElementById("rate").innerHTML = `<option>0</option>`;
        }
    });
}
</script>
</body>
</html>
