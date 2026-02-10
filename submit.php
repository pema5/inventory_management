<?php
include "db.php";

// Check if form is submitted
if(isset($_POST['submit'])){

    // Get values safely
    $productcode = $_POST['productcode'] ?? '';
    $productname = $_POST['productname'] ?? '';
    $producttype = $_POST['producttype'] ?? '';
    $productunit = $_POST['productunit'] ?? '';
    $salesrate = $_POST['salesrate'] ?? '';

    // Handle file upload
    $uploadphoto = '';
    if(isset($_FILES['uploadphoto']) && $_FILES['uploadphoto']['name'] != ''){
        $file_name = $_FILES['uploadphoto']['name'];
        $file_tmp = $_FILES['uploadphoto']['tmp_name'];
        $upload_dir = "uploads/";
        if(!is_dir($upload_dir)) mkdir($upload_dir);
        move_uploaded_file($file_tmp, $upload_dir.$file_name);
        $uploadphoto = $file_name;
    }

    // Insert into database only if all required fields are filled
    if($productcode != '' && $productname != '' && $producttype != '' && $productunit != '' && $salesrate != ''){
        $sql = "INSERT INTO products (productcode, productname, producttype, productunit, salesrate, uploadphoto) 
                VALUES ('$productcode','$productname','$producttype','$productunit','$salesrate','$uploadphoto')";
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        header("Location: viewProduct.php");
        exit();
    } else {
        echo "Please fill all required fields.";
    }

} else {
    // If someone opens submit.php directly, redirect to form
    header("Location: productEntry.html");
    exit();
}
?>
