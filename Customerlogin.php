<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root";
    $password_db = "root";
    $dbname = "my_database";

    $conn = mysqli_connect($servername, $username, $password_db, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM customers WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: search_products.php');
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "No user found with that email.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Login</title>
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

        .login-form {
            max-width: 320px;
            margin: 60px auto;
            padding: 22px;
            background: lightblue;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.35);
            text-align: center;
        }

        h2 {
            margin-bottom: 15px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 9px;
            margin-bottom: 12px;
            border-radius: 6px;
            border: 1.5px solid #ccc;
        }

        input:focus {
            outline: none;
            border-color: #5f3fb0;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #5f3fb0;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #4a2ea0;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<div class="overlay">

    <div class="login-form">
        <h2>Customer Login</h2>

        <?php if (isset($error_message)) { ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php } ?>

        <form method="POST" action="Customerlogin.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>
    </div>

</div>
</body>
</html>
