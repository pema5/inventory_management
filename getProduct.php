<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost","root","root","my_database");
if($conn->connect_error){
    die(json_encode(['error'=>'Database connection failed']));
}

if(!isset($_GET['code']) || empty($_GET['code'])){
    echo json_encode(['error'=>'No product code provided']);
    exit;
}

$code = $conn->real_escape_string($_GET['code']);
$res = $conn->query("SELECT product_name, product_unit, sales_rate FROM product_entry WHERE product_code='$code'");

if($res->num_rows > 0){
    $data = $res->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(['error'=>'Product not found']);
}
?>
