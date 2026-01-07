<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Arial, sans-serif;

            /* CLEAR background image */
            background-image: url("super.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Light overlay reduced for clearer image */
        .overlay {
            min-height: 100vh;
            background: rgba(255, 255, 255, 0.15); /* reduced opacity */
            padding-top: 60px;
        }

        /* Login card – unchanged */
        .form {
            max-width: 320px;
            margin: 70px auto;
            padding: 20px;
            background: lightblue;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.35);
            color: #000;
        }

        .fieldset {
            border: none;
            padding: 0;
        }

        .legend {
            text-align: center;
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .adminPic {
            display: block;
            margin: 0 auto 15px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            border: 2px solid #5f3fb0;
            background: #fff;
        }

        label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: #222;
        }

        input {
            width: 100%;
            padding: 9px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1.5px solid #ccc;
            background: #fff;
            color: #000;
        }

        input:focus {
            outline: none;
            border-color: #5f3fb0;
        }

        .submit {
            width: 100%;
            padding: 9px;
            background: #5f3fb0;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .submit:hover {
            background: #5f3fb0;
        }

        .signup {
            text-align: center;
            margin-top: 10px;
            font-size: 0.85rem;
        }

        .signup a {
            color: #5f3fb0;
            text-decoration: none;
            font-weight: 600;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="overlay">

    <form class="form" action="insert.php" method="post">
        <fieldset class="fieldset">
            <legend class="legend">Login</legend>

            <img src="admin.png" class="adminPic" alt="Admin">

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button class="submit" name="submit">Login</button>

            <div class="signup">
                Don’t have an account? <a href="signup.html">Sign up</a>
            </div>
        </fieldset>
    </form>

</div>

</body>
</html>
