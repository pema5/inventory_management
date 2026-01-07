<?php
include "db.php"; // single db connection

$message = "";

// Handle form submission
if(isset($_POST['submit'])){
    $productcode = $_POST['productcode'] ?? '';
    $productname = $_POST['productname'] ?? '';
    $producttype = $_POST['producttype'] ?? '';
    $productunit = $_POST['productunit'] ?? '';
    $salesrate = $_POST['salesrate'] ?? '';

    // Handle file upload
    $uploadphoto = '';
    if(isset($_FILES['uploadphoto']) && $_FILES['uploadphoto']['error'] === UPLOAD_ERR_OK){
        $file_name = $_FILES['uploadphoto']['name'];
        $file_tmp = $_FILES['uploadphoto']['tmp_name'];
        $upload_dir = "uploads/";
        if(!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        move_uploaded_file($file_tmp, $upload_dir.$file_name);
        $uploadphoto = $file_name;
    }

    if($productcode && $productname && $producttype && $productunit && $salesrate){
        $sql = "INSERT INTO productentry (productcode, productname, producttype, productunit, salesrate, uploadphoto) 
                VALUES ('$productcode','$productname','$producttype','$productunit','$salesrate','$uploadphoto')";
        if(mysqli_query($conn, $sql)){
            $message = "<p style='color:green;text-align:center;'>Product added successfully!</p>";
        } else {
            $message = "<p style='color:red;text-align:center;'>Error: ".mysqli_error($conn)."</p>";
        }
    } else {
        $message = "<p style='color:red;text-align:center;'>Please fill all required fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Entry</title>
<style>
body { font-family: Arial; background:#f4f4f4; padding:20px; }
h2 { color:#6a5acd; text-align:center; }
form { background:#fff; border-radius:8px; padding:20px; box-shadow:0 0 10px rgba(0,0,0,0.1); max-width:400px; margin:auto; }
div { margin-bottom:15px; }
label { color:#4b0082; display:block; margin-bottom:5px; }
input[type="text"], input[type="number"], input[type="file"] { width:100%; padding:10px; border:1px solid #6a5acd; border-radius:4px; box-sizing:border-box; }
input[type="submit"] { background-color:#6a5acd; color:white; padding:10px; border:none; border-radius:4px; cursor:pointer; font-size:16px; width:100%; }
input[type="submit"]:hover { background-color:#483d8b; }
.message { margin-bottom:15px; text-align:center; }
</style>
</head>
<body>

<h2>Product Entry Form</h2>

<?php if($message) echo "<div class='message'>$message</div>"; ?>

<form method="POST" action="" enctype="multipart/form-data">
    <div>
        <label>Product Code:</label>
        <input type="number" name="productcode" required>
    </div>
    <div>
        <label>Product Name:</label>
        <input type="text" name="productname" required>
    </div>
    <div>
        <label>Product Type:</label>
        <input type="text" name="producttype" required>
    </div>
    <div>
        <label>Product Unit:</label>
        <input type="number" name="productunit" required>
    </div>
    <div>
        <label>Sales Rate:</label>
        <input type="number" step="0.01" name="salesrate" required>
    </div>
    <div>
        <label>Upload Photo:</label>
        <input type="file" name="uploadphoto">
    </div>
    <div>
        <input type="submit" name="submit" value="Submit">
    </div>
</form>

</body>
</html>