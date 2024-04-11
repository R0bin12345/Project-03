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
            border: 1px solid #ddd; /* Add border around the table */
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Add border bottom for each cell */
            border-right: 1px solid #ddd; /* Add border right for each cell */
            color: white; /* Make the text color white */
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
    include 'connect1.php'; // Inclusief het bestand connect1.php voor databaseverbinding

    // Prepare the SQL query to retrieve data from the bestelling table
    $query = $db->prepare("SELECT `bestelcode`, `bestel`, `productcode`, `aantal` FROM `bestelling` WHERE 1");

    // Execute the prepared query
    $query->execute();

    // Fetch all results as an associative array
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
        <tr class='fixed-header'>
            <th class='sortable' onclick='sortTable(0)'>Bestelcode</th>
            <th class='sortable' onclick='sortTable(1)'>Bestel</th>
            <th class='sortable' onclick='sortTable(2)'>Productcode</th>
            <th class='sortable' onclick='sortTable(3)'>Aantal</th>
            <th>Acties</th>
        </tr>

        <?php
        // Loop through the results and add a row for each record
        foreach ($result as $data) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($data['bestelcode']) . "</td>";
            echo "<td>" . htmlspecialchars($data['bestel']) . "</td>";
            echo "<td>" . htmlspecialchars($data['productcode']) . "</td>";
            echo "<td>" . htmlspecialchars($data['aantal']) . "</td>";
            echo "<td><a href='verwijder.php?id=" . $data['bestel'] . "' onclick='return confirmDelete()'>Verwijder</a></td>";
            echo "</tr>";
        }
        ?>

    </table>
</main>

<footer>
    <p>&copy; 2024 Your Website. All rights reserved.</p>
</footer>

</body>
</html>
