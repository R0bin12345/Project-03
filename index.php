<?php
include 'connect.php'; // Inclusief het bestand connect.php voor databaseverbinding

// Query om alle klanten op te halen
$query = $db->prepare("SELECT * FROM klant");
$query->execute();
$klanten = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Klantenlijst</title>
    <style>
        /* CSS-stijlen voor de tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>

<body>

    <h2>Klantenlijst</h2>

    <!-- Tabel met klantgegevens -->
    <table>
        <tr>
            <th>Klantcode</th>
            <th>Naam</th>
            <th>Adres</th>
            <th>Plaats</th>
            <th>Contact</th>
            <th>Postcode</th>
            <th>Land</th>
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
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>
