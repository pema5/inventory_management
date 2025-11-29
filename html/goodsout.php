<?php
$hostname = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";  

// Creating connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// Checking for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['customer_name']) && !empty($_POST['customer_no']) && !empty($_POST['product_name']) && 
        !empty($_POST['product_id']) && !empty($_POST['product_quantity']) && !empty($_POST['product_unit']) && !empty($_POST['date'])) {
        
        // Assign form values to variables
        $customer_name = $_POST['customer_name'];
        $phone_number = $_POST['customer_no'];
        $product_name = $_POST['product_name'];
        $product_id = $_POST['product_id'];
        $quantity = (int)$_POST['product_quantity'];
        $unit = $_POST['product_unit'];
        $date = $_POST['date'];

        // Check if product exists and get current stock
        $stmt = $conn->prepare("SELECT product_unit FROM productentry WHERE product_code = ?");
        $stmt->bind_param("s", $product_id);
        $stmt->execute();
        $stmt->bind_result($current_stock);
        $stmt->fetch();
        $stmt->close();

        if ($current_stock !== null) {
            if ($current_stock >= $quantity) {
                // Insert into GoodsOut table
                $stmt = $conn->prepare("INSERT INTO Goodsout (customer_name, phone_number, product_name, product_id, quantity, unit, date) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssiss", $customer_name, $phone_number, $product_name, $product_id, $quantity, $unit, $date);
                $stmt->execute();
                $stmt->close();

                // Update stock in productentry table
                $new_stock = $current_stock - $quantity;
                $stmt = $conn->prepare("UPDATE productentry SET product_unit = ? WHERE product_code = ?");
                $stmt->bind_param("is", $new_stock, $product_id);
                $stmt->execute();
                $stmt->close();

                // Redirect to goodsout.php to display updated stock and transactions
                header("Location: ViewProduct.php");
                exit();
            } else {
                echo "Error: Insufficient stock.";
            }
        } else {
            echo "Error: Product not found.";
        }
    } else {
        echo "Please fill out all required fields.";
    }
}   

$conn->close();
?>
