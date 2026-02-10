<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ');
    exit();
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "my_database";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search logic
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$searchFilter = !empty($search_query) ? "WHERE productname LIKE '%$search_query%' OR producttype LIKE '%$search_query%'" : '';

$sql = "SELECT productcode, productname, producttype, productunit, salesrate, uploadphoto FROM productentry $searchFilter";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #6a5acd; 
            text-align: center;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: auto;
            text-align: center;
        }

        .search-form {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .search-form input {
            padding: 10px;
            width: 60%;
            font-size: 16px;
            border: 1px solid #6a5acd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .search-form button {
            padding: 10px;
            background-color: #6a5acd;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }

        .search-form button:hover {
            background-color: #483d8b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            color: black;
            font-size: 16px;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #6a5acd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: #6a5acd;
            color: white;
            font-size: 18px;
        }

        tbody tr:nth-child(even) {
            background: #f0f0ff;
        }

        tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Products</h2>
        <form method="GET" action="search_products.php" class="search-form">
            <input type="text" name="search" placeholder="Search for products..." value="<?php echo $search_query; ?>">
            <button type="submit">Search</button>
        </form>

        <h3>Product List:</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Type</th>
                    <th>Product Unit</th>
                    <th>Sales Rate (Rs)</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $product['productcode'] . "</td>";
                        echo "<td>" . $product['productname'] . "</td>";
                        echo "<td>" . $product['producttype'] . "</td>";
                        echo "<td>" . $product['productunit'] . "</td>";
                        echo "<td>Rs " . $product['salesrate'] . "</td>";

                        // Display product image
                        $imagePath = "uploads/" . $product['uploadphoto'];
                        if (!empty($product['uploadphoto']) && file_exists($imagePath)) {
                            echo "<td><img src='$imagePath' alt='Product Image'></td>";
                        } else {
                            echo "<td>No Image</td>";
                        }

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No products found.</td></tr>";
                }

                
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
