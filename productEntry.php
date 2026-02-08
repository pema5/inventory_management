<?php
include "db.php";

if(isset($_POST['submit'])){

    $productcode = $_POST['productcode'];
    $productname = $_POST['productname'];
    $producttype = $_POST['producttype'];
    $productunit = $_POST['productunit'];
    $salesrate = $_POST['salesrate'];

    $uploadphoto = "";

    if($_FILES['uploadphoto']['name'] != ""){
        $uploadphoto = $_FILES['uploadphoto']['name'];
        move_uploaded_file($_FILES['uploadphoto']['tmp_name'], "uploads/".$uploadphoto);
    }

    $sql = "INSERT INTO productentry 
    (productcode, productname, producttype, productunit, salesrate, uploadphoto)
    VALUES
    ('$productcode','$productname','$producttype','$productunit','$salesrate','$uploadphoto')";

    if(mysqli_query($conn,$sql)){
        header("Location: viewProduct.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Product Entry</title>
</head>

<body>

<h2>Add Product</h2>

<form method="POST" enctype="multipart/form-data">
    Product Code:<br>
    <input type="number" name="productcode"><br><br>

    Product Name:<br>
    <input type="text" name="productname"><br><br>

    Product Type:<br>
    <input type="text" name="producttype"><br><br>

    Product Unit:<br>
    <input type="number" name="productunit"><br><br>

    Sales Rate:<br>
    <input type="number" name="salesrate"><br><br>

    Photo:<br>
    <input type="file" name="uploadphoto"><br><br>

    <input type="submit" name="submit" value="Add Product">
</form>

</body>
</html>
