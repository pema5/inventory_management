<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Store Management System - Dashboard</title>

<style>
html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: "Segoe UI", Arial, sans-serif;
}

/* BODY */
body {
    display: flex;
    flex-direction: column;
}

/* TOP BAR */
.top-bar {
    background-color: rgba(210, 180, 140, 0.45);
    color: black;
    padding: 10px 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.marquee {
    font-size: 22px;
    font-weight: bold;
    margin-right: 15px;
}

.location {
    font-size: 16px;
}

/* NAVBAR */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 25px;
    background-color: rgba(210, 180, 140, 0.45);
}

.navbar a {
    color: black;
    text-decoration: none;
    margin: 0 12px;
    font-size: 18px;
    font-weight: 500;
}

.navbar a:hover {
    text-decoration: underline;
}

/* DROPDOWN */
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: rgba(255,255,255,0.95);
    min-width: 140px;
    border-radius: 6px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.dropdown-content a {
    display: block;
    padding: 8px 12px;
    font-size: 15px;
}

.dropdown:hover .dropdown-content {
    display: block;
}

/* SEARCH */
.search-container {
    display: flex;
}

.search-input {
    padding: 6px 10px;
    border-radius: 4px;
    border: 1px solid #aaa;
}

.search-button {
    margin-left: 5px;
    padding: 6px 12px;
    border: 1px solid #555;
    background: transparent;
    cursor: pointer;
}

/* IMAGE SECTION (NO BLUR) */
.hero-section {
    flex: 1;
    width: 100%;
    background-image: url('super.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

/* FOOTER */
footer {
    text-align: center;
    padding: 10px 0;
    font-size: 14px;
    color: black;
}
</style>
</head>

<body>

<div class="top-bar">
    <marquee class="marquee">Store Management System</marquee>
    <span class="location">Kapan, Kathmandu</span>
</div>

<div class="navbar">
    <div>
        <a href="dashboard.php">Home</a>
        <a href="news.html">News</a>
        <a href="contact.html">Contact</a>

        <div class="dropdown">
            <a href="#">Login</a>
            <div class="dropdown-content">
                <a href="login.php">Admin</a>
                <a href="Employeelogin.php">Employee</a>
                <a href="Customerlogin.php">Customer</a>
            </div>
        </div>

        <div class="dropdown">
            <a href="#">Register</a>
            <div class="dropdown-content">
                <a href="#">Admin</a>
                <a href="#">Employee</a>
                <a href="#">Customer</a>
            </div>
        </div>
    </div>

    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search...">
        <button class="search-button">Go</button>
    </div>
</div>

<!-- SHARP IMAGE BELOW NAVBAR -->
<div class="hero-section"></div>

<footer>
© 2025 Inventory Management System. All rights reserved.
</footer>

</body>
</html>
