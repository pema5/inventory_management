<?php
$host = 'localhost';
$dbname = 'my_database';
$username = 'root';
$password_db = 'root';

$conn = mysqli_connect($host, $username, $password_db, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone      = $_POST['phone'];
    $address    = $_POST['address'];

    $sql = "INSERT INTO customers (first_name, last_name, email, password, phone, address)
            VALUES ('$first_name', '$last_name', '$email', '$password', '$phone', '$address')";

    if (mysqli_query($conn, $sql)) {
        $success = true;
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Customer Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    body {
        margin: 0;
        min-height: 100vh;
        font-family: "Segoe UI", Arial, sans-serif;
        background-image: url("super.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .overlay {
        min-height: 100vh;
        background: rgba(255, 255, 255, 0.15);
        padding-top: 60px;
    }

    .box {
        max-width: 380px;
        margin: auto;
        padding: 25px;
        background: lightblue;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.35);
        text-align: center;
    }

    h2 {
        color: #333;
        margin-bottom: 15px;
    }

    p {
        font-size: 0.95rem;
        color: #222;
        margin-bottom: 20px;
    }

    input, textarea {
        width: 100%;
        padding: 9px;
        margin-bottom: 12px;
        border-radius: 6px;
        border: 1.5px solid #ccc;
    }

    textarea {
        resize: none;
    }

    button, a.btn {
        display: block;
        width: 100%;
        padding: 10px;
        background: #5f3fb0;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
    }

    button:hover, a.btn:hover {
        background: #4a2ea0;
    }

    .error {
        color: red;
        margin-bottom: 10px;
    }
</style>
</head>

<body>
<div class="overlay">

<?php if ($success): ?>
    <!-- SUCCESS MESSAGE BOX -->
    <div class="box">
        <h2>Registration Successful 🎉</h2>
        <p>
            You are registered successfully.<br>
            Please go to the login page to continue.
        </p>
        <a href="Customerlogin.php" class="btn">Go to Login</a>
    </div>

<?php else: ?>
    <!-- REGISTRATION FORM -->
    <form class="box" method="post">
        <h2>Customer Registration</h2>

        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <textarea name="address" rows="2" placeholder="Address" required></textarea>

        <button type="submit">Register</button>
    </form>
<?php endif; ?>

</div>
</body>
</html>
