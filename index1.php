<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bestellingenlijst</title>

    <style>
        /* Voeg wat ruimte toe tussen de kolommen van de tabel */
        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #fff; /* Voeg een rand rond de tabel toe */
            color: #fff; /* Maak de tekstkleur wit */
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd; /* Voeg een ondergrens toe voor elke cel */
            border-right: 1px solid #ddd; /* Voeg een rechterrand toe voor elke cel */
        }
        th:last-child, td:last-child {
            border-right: none; /* Verwijder de rechterrand voor de laatste kolom */
        }
        /* Voeg wat ruimte toe tussen de tabelkop en de inhoud */
        .fixed-header {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<header>
    <h1>Bestellingenlijst</h1>
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
    // Inclusief het connect.php-bestand om een databaseverbinding tot stand te brengen
    include 'connect.php';

    // Query om gegevens uit de klantentabel op te halen
    $query = $db->prepare("SELECT * FROM bestelling");
    $query->execute();
    $bestellingen = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Tabel om bestelgegevens weer te geven -->
    <table>
        <tr>
            <th>Bestelcode</th>
            <th>Productcode</th>
            <th>Aantal</th>
            <th>Acties</th> <!-- Nieuwe kolom voor acties -->
        </tr>
        <?php foreach ($bestellingen as $bestelling) : ?>
            <tr>
                <td><?php echo $bestelling['bestelcode']; ?></td>
                <td><?php echo $bestelling['productcode']; ?></td>
                <td><?php echo $bestelling['aantal']; ?></td>
                <td>
                    <!-- Bewerkknop -->
                    <a href="edit_besteling.php?bestelcode=<?php echo $bestelling['bestelcode']; ?>">Bewerk</a>
                    <!-- Verwijderknop -->
                    <a href="delete_besteling.php?bestelcode=<?php echo $bestelling['bestelcode']; ?>">Verwijder</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Knop om een bestelling toe te voegen -->
    <a href="add_besteling.php">Voeg bestelling toe</a>
    <!-- Bewerkknop -->
    <a href="edit_besteling.php?bestelcode=<?php echo $bestelling['bestelcode']; ?>">Bewerk</a>
                    <!-- Verwijderknop -->
                    <a href="delete_besteling.php?bestelcode=<?php echo $bestelling['bestelcode']; ?>">Verwijder</a>
</main>

<footer>
    <p>&copy; 2024 Your Website. Alle rechten voorbehouden.</p>
</footer>

</body>

</html>
