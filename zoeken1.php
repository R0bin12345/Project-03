
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bestellijst</title>
    <style>
        /* Interne CSS-stijlen voor het opmaken van de tabel en formuliervelden. */
        table, th, td {
            border: 1px solid black; /* Maakt een zwarte rand van 1px rond tabellen en cellen. */
            border-collapse: collapse; /* Verwijdert dubbele randen tussen cellen. */
            padding: 8px; /* Voegt 8px padding toe binnenin de tabelheader (th) en cellen (td) voor betere leesbaarheid. */
            text-align: left; /* Links uitlijnen van tekst in de header en cellen. */
        }

        th {
            cursor: pointer; /* Verandert de cursor in een pointer (handje) om aan te geven dat de header klikbaar is voor sortering. */
        }

        form {
            margin-bottom: 20px; /* Voegt 20px marge toe onder het formulier voor ruimte tussen het formulier en de tabel. */
        }
    </style>
</head>

<body>
    <form action="" method="get">
        <!-- Formulier voor het zoeken naar klantnaam. Gebruikt GET-methode voor de zoekopdracht.-->
        <label for="search">Zoek bestelling: </label>
        <input type="text" id="search" name="search" value="">
        <!-- Tekstveld voor het invoeren van de zoekopdracht. -->
        <input type="submit" value="Zoeken">
    </form>

    <?php
    include 'connect1.php'; // Include het bestand connect.php' voor de databaseverbinding.
    $search = $_GET['search'] ?? ''; // Haalt de zoekterm op uit de URL of zet een lege string als standaard.
    $query = $db->prepare("SELECT bestelcode, bestel, productcode, aantal FROM bestelling WHERE bestel LIKE :search ORDER BY bestelcode");
    // Bereidt een SQL-query voor met een placeholder voor de zoekterm.
    // Vervangt de placeholder door de zoekterm, omgeven door procenttekens voor gedeeltelijke overeenkomsten.
    $query->bindValue(":search", "%" . $search . "%");
    $query->execute(); // Voert de query uit.
    $result = $query->fetchAll(PDO::FETCH_ASSOC); // Haalt de resultaten op als een associatieve array.
    echo "<table>"; // Start de HTML-tabel.
    echo "<tr><th onclick='sortTable(0)'>Bestelcode</th><th onclick='sortTable(1)'>bestel</th><th onclick='sortTable(2)'>Productcode</th><th onclick='sortTable(3)'>Aantal</th></tr>";
    // Headerrij met kolomnamen, die ook dienen als knoppen voor sortering.
    foreach ($result as $row) {
        // Loopt door elk resultaat en voegt een rij toe aan de tabel voor elke record.
        echo "<tr><td>" . htmlspecialchars($row['bestelcode']) . "</td><td>" . htmlspecialchars($row["bestel"]) . "</td><td>" . htmlspecialchars($row['productcode']) . "</td><td>" . htmlspecialchars($row['aantal']) . "</td></tr>";
    }
    echo "</table>"; // Sluit de tabel af.
    ?>

    <script>
        // JavaScript-functie voor het sorteren van de tabel gebaseerd op kolom.
        function sortTable(column) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.querySelector("table"); // Selecteert de tabel.
            switching = true; // Bool om de while-loop te starten.
            dir = "asc"; // Beginrichting van sortering.
            while (switching) {
                switching = false; // Stopt de loop tenzij er een wisseling plaatsvindt.
                rows = table.rows; // Haalt alle rijen van de tabel op.
                for (i = 1; i < rows.length - 1; i++) {
                    shouldSwitch = false; // Reset de switch-indicator.
                    // Haalt de twee elementen op om te vergelijken, één uit de huidige rij en één uit de volgende.
                    x = rows[i].getElementsByTagName("TD")[column];
                    y = rows[i + 1].getElementsByTagName("TD")[column];
                    // Controleert of de twee rijen moeten wisselen van plaats.
                    if (dir == "asc" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase() || dir == "desc" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true; // Markeert dat er een wisseling moet plaatsvinden.
                        break;
                    }
                }
                if (shouldSwitch) {
                    // Voert de wissel uit en markeert dat er een wisseling heeft plaatsge
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else if (switchcount == 0 && dir == "asc") {
                    // Als er geen wisseling heeft plaatsgevonden en de richting oplopend is, verandert de richting en start de loop opnieuw.
                    dir = "desc";
                    switching = true;
                }
            }
        }
    </script>
</body>

</html>
