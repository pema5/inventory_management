<?php
include "db.php"; // your database connection

// Fetch all products
$result = mysqli_query($conn, "SELECT * FROM products");
if(!$result){
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e0e4f0;
            padding: 50px;
        }
        h2 {
            text-align: center;
            color: #4b0082;
            font-size: 36px;
            margin-bottom: 40px;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
            font-size: 18px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 20px;
            text-align: center;
        }
        th {
            background: #6a5acd;
            color: white;
            font-size: 20px;
        }
        tr:hover {
            background: #dcdcff;
        }
        a {
            color: #6a5acd;
            text-decoration: none;
            margin: 0 8px;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        img {
            border-radius: 8px;
            width: 100px; /* bigger image */
            height: auto;
        }
        @media screen and (max-width: 1200px){
            table {
                font-size: 16px;
            }
            th, td {
                padding: 15px;
            }
            img {
                width: 80px;
            }
        }
        @media screen and (max-width: 768px){
            table {
                width: 100%;
                font-size: 14px;
            }
            th, td {
                padding: 10px;
            }
            img {
                width: 60px;
            }
        }
    </style>
</head>
<body>

<h2>Product List</h2>

<table>
<tr>
    <th>Code</th>
    <th>Name</th>
    <th>Type</th>
    <th>Unit</th>
    <th>Rate</th>
    <th>Image</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['productcode']; ?></td>
    <td><?php echo $row['productname']; ?></td>
    <td><?php echo $row['producttype']; ?></td>
    <td><?php echo $row['productunit']; ?></td>
    <td><?php echo $row['salesrate']; ?></td>
    <td>
        <?php if($row['uploadphoto'] != '') { ?>
            <img src="uploads/<?php echo $row['uploadphoto']; ?>" alt="Product Image">
        <?php } ?>
    </td>
    <td>
        <a href="update.php?code=<?php echo $row['productcode']; ?>">Edit</a> |
        <a href="delete.php?code=<?php echo $row['productcode']; ?>" onclick="return confirm('Delete this product?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
