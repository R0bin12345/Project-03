<?php
include "connect1.php"; // Verbind met de database

// Zoekfunctionaliteit
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchCondition = $search ? "WHERE klantnaam LIKE '%$search%'" : '';

// Sorteerfunctionaliteit
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ASC';
$orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'klantnaam';
$sortIcon = $sort === 'ASC' ? '&uarr;' : '&darr;';

// Maak een query met zoek- en sorteervoorwaarden voor de "product" -tabel
$sql = "SELECT * FROM product $searchCondition ORDER BY $orderBy $sort";

// Bereid de query voor
$stmt = $conn->prepare($sql);

// Uitvoeren van de query
$stmt->execute();

// Ophalen van alle gegevens
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productlijst</title>
    <style>
        /* CSS-styling voor de tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            cursor: pointer;
        }
        /* Stijl voor de vaste kop */
        .fixed-header {
            position: sticky;
            top: 0;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <!-- Zoekveld -->
    <form action="index1.php" method="GET">
        <label for="search">Zoek op klantnaam:</label>
        <input type="text" name="search" id="search" value="<?php echo $search; ?>">
        <input type="submit" value="Zoek">
    </form>

    <!-- Tabel met gegevens -->
    <table>
        <tr class="fixed-header">
            <th onclick="sortTable('bestelcode')">Bestelcode <?php echo $orderBy === 'bestelcode' ? $sortIcon : ''; ?></th>
            <th onclick="sortTable('bestel')">bestel <?php echo $orderBy === 'bestel' ? $sortIcon : ''; ?></th>
            <th onclick="sortTable('productcode')">Productcode <?php echo $orderBy === 'productcode' ? $sortIcon : ''; ?></th>
            <th onclick="sortTable('aantal')">Aantal <?php echo $orderBy === 'aantal' ? $sortIcon : ''; ?></th>
        </tr>

        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo htmlspecialchars($row['bestelcode']); ?></td>
                <td><?php echo htmlspecialchars($row['bestel']); ?></td>
                <td><?php echo htmlspecialchars($row['productcode']); ?></td>
                <td><?php echo htmlspecialchars($row['aantal']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        // JavaScript-functie om de tabel te sorteren op basis van de geklikte kolom
        function sortTable(columnIndex) {
            let table, rows, switching, i, x, y, shouldSwitch;
            table = document.querySelector("table");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
    </script>
</body>
</html>
