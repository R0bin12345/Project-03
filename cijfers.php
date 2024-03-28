<?php
// Auteur: Robin
// Functie: Selecteer Data

// Connect database
include "connect.php";

// Zoekfunctionaliteit
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchCondition = $search ? "WHERE leerling LIKE '%$search%'" : '';

// Sorteerfunctionaliteit
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ASC';
$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'klantnaam';
$sortIcon = $sort === 'ASC' ? '&uarr;' : '&darr;';

// Maak een query met zoek- en sorteervoorwaarden
$sql = "SELECT * FROM klant $searchCondition ORDER BY $orderBy $sort";

// Bereid de query voor
$stmt = $conn->prepare($sql);

// Uitvoeren
$stmt->execute();

// Ophalen alle data
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script>
    // JavaScript for sorteren
    function sortTable(column) {
        window.location.href = `index.php?sort=<?php echo $sort === 'ASC' ? 'DESC' : 'ASC'; ?>&orderBy=${column}`; // <-- This line is fine
    }
</script>

</head>
<body>

<style>
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

<!-- Zoekveld -->
<form action="index.php" method="GET">
    <label for="search">Zoek op naam:</label>
    <input type="text" name="search" id="search" value="<?php echo $search; ?>">
    <input type="submit" value="Zoek">
</form>

<!-- Tabel met gegevens -->
<table>
    <tr>
        <th onclick="sortTable('klantnaam')">klantnaam <?php echo $orderBy === 'klantnaam' ? $sortIcon : ''; ?></th>
        <th onclick="sortTable('klantadres')">klantadres <?php echo $orderBy === 'klantadres' ? $sortIcon : ''; ?></th>
    </tr>

    <?php foreach ($result as $row) : ?>
        <tr>
            <td><?php echo $row['klantnaam']; ?></td>
            <td><?php echo $row['klantadres']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
