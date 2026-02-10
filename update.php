<?php
$conn = mysqli_connect("localhost", "root", "root", "my_database");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$row = null;

/* -------- Determine product code (GET or POST) -------- */
if (isset($_GET['code'])) {
    $code = $_GET['code'];
} elseif (isset($_POST['productcode'])) {
    $code = $_POST['productcode'];
} else {
    $code = null;
}

/* -------- Load product -------- */
if ($code !== null) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM productentry WHERE productcode = ?");
    mysqli_stmt_bind_param($stmt, "s", $code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    mysqli_stmt_close($stmt);
}

/* -------- Update product -------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $row !== null) {

    $productCode = $_POST['productcode'];
    $productName = $_POST['productname'];
    $productType = $_POST['producttype'];
    $productUnit = $_POST['productunit'];
    $salesRate   = $_POST['salesrate'];

    $photoSql = "";
    if (!empty($_FILES['uploadphoto']['name'])) {
        $photo = time() . "_" . basename($_FILES['uploadphoto']['name']);
        move_uploaded_file($_FILES['uploadphoto']['tmp_name'], "uploads/" . $photo);
        $photoSql = ", uploadphoto=?";
    }

    if ($photoSql) {
        $stmt = mysqli_prepare($conn,
            "UPDATE productentry SET
                productname=?,
                producttype=?,
                productunit=?,
                salesrate=?
                $photoSql
             WHERE productcode=?"
        );
        mysqli_stmt_bind_param(
            $stmt,
            "sssdss",
            $productName,
            $productType,
            $productUnit,
            $salesRate,
            $photo,
            $productCode
        );
    } else {
        $stmt = mysqli_prepare($conn,
            "UPDATE productentry SET
                productname=?,
                producttype=?,
                productunit=?,
                salesrate=?
             WHERE productcode=?"
        );
        mysqli_stmt_bind_param(
            $stmt,
            "sssds",
            $productName,
            $productType,
            $productUnit,
            $salesRate,
            $productCode
        );
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: viewProduct.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background:#eef1fb;
        }
        .container{
            width:420px;
            margin:80px auto;
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 8px 20px rgba(0,0,0,0.15);
        }
        h2{
            text-align:center;
            color:#4b0082;
            margin-bottom:25px;
        }
        label{
            font-weight:bold;
            display:block;
            margin-top:15px;
        }
        input[type=text], input[type=file]{
            width:100%;
            padding:10px;
            margin-top:5px;
            border-radius:5px;
            border:1px solid #aaa;
        }
        button{
            margin-top:25px;
            width:100%;
            padding:12px;
            background:#6a5acd;
            color:#fff;
            border:none;
            border-radius:6px;
            font-size:16px;
            cursor:pointer;
        }
        button:hover{
            background:#483d8b;
        }
        .error{
            color:red;
            text-align:center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>

    <?php if ($row === null) { ?>
        <p class="error">Invalid product selected.</p>
    <?php } else { ?>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="productcode" value="<?php echo htmlspecialchars($row['productcode']); ?>">

        <label>Name</label>
        <input type="text" name="productname" value="<?php echo htmlspecialchars($row['productname']); ?>" required>

        <label>Type</label>
        <input type="text" name="producttype" value="<?php echo htmlspecialchars($row['producttype']); ?>" required>

        <label>Unit</label>
        <input type="text" name="productunit" value="<?php echo htmlspecialchars($row['productunit']); ?>" required>

        <label>Rate</label>
        <input type="text" name="salesrate" value="<?php echo htmlspecialchars($row['salesrate']); ?>" required>

        <label>Image</label>
        <input type="file" name="uploadphoto">

        <button type="submit">Update Product</button>
    </form>

    <?php } ?>
</div>

</body>
</html>
