<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Your Website</title>

    <style>
        /* Add spacing between table columns */
        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #fff; /* Add border around the table */
            color: #fff; /* Make the text color white */
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Add border bottom for each cell */
            border-right: 1px solid #ddd; /* Add border right for each cell */
        }
        th:last-child, td:last-child {
            border-right: none; /* Remove border right for the last column */
        }
        /* Add some space between the table header and content */
        .fixed-header {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<header>
    <h1>Klantenlijst</h1>
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
    // Include the connect.php file to establish a database connection
    include 'connect.php';

    // Query to retrieve data from the klant table
    $query = $db->prepare("SELECT * FROM klant");
    $query->execute();
    $klanten = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>

   

    <!-- Table to display customer data -->
    <table>
        <tr>
            <th>Klantcode</th>
            <th>Naam</th>
            <th>Adres</th>
            <th>Plaats</th>
            <th>Contact</th>
            <th>Postcode</th>
            <th>Land</th>
            <th>Acties</th> <!-- New column for actions -->
        </tr>
        <?php foreach ($klanten as $klant) : ?>
            <tr>
                <td><?php echo $klant['klantcode']; ?></td>
                <td><?php echo $klant['klantnaam']; ?></td>
                <td><?php echo $klant['klantadres']; ?></td>
                <td><?php echo $klant['klantplaats']; ?></td>
                <td><?php echo $klant['klantcontact']; ?></td>
                <td><?php echo $klant['klantpostcode']; ?></td>
                <td><?php echo $klant['klantcountry']; ?></td>
                <td>
                    <!-- Edit button -->
                    <a href="edit_customer.php?klantcode=<?php echo $klant['klantcode']; ?>">Bewerk</a>
                    <!-- Delete button -->
                    <a href="delete_customer.php?klantcode=<?php echo $klant['klantcode']; ?>">Verwijder</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Toevoegen knop -->
    <a href="add_customer.php">Voeg klant toe</a>
</main>

<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>

</body>

</html>
