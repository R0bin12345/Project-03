<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Your Website</title>
</head>

<body>

    <header>
        <h1>Producten</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="crud_product.php">Producten</a></li>
                <li><a href="index.php">Admin</a></li>
                <li><a href="index1.php">Bestellingen</a></li>
            </ul>
        </nav>
    </header>
    <main>


<?php
// Include the functions.php file to access its functions
include 'functions.php';

// Main

// Call the function crudProduct (assuming it's defined in functions.php)
crudProduct(); // Change this line to use 'crudProduct()' with a capital 'P'
?>
</main>
</body>
<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>
</html>