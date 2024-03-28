<?php
include 'connect1.php';

// Prepare the SQL query to retrieve data from the product table
$query = $db->prepare("SELECT bestel,bestelcode, bestel, productcode, aantal FROM bestelling");

// Execute the prepared query
$query->execute();

// Fetch all results as an associative array
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// Start the HTML table and add column headers with class 'sortable'
echo "<table>";
echo "<tr class='fixed-header'><th class='sortable' onclick='sortTable(0)'>Bestelcode</th><th class='sortable' onclick='sortTable(1)'>bestel</th><th class='sortable' onclick='sortTable(2)'>Productcode</th><th class='sortable' onclick='sortTable(3)'>Aantal</th><th>Acties</th></tr>";

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

echo "</table>"; // Close the table
?>

<script>
    // JavaScript function that shows a confirmation dialog when a user clicks 'Verwijder'
    function confirmDelete() {
        return confirm("Weet je zeker dat je het record wilt verwijderen?");
    }

    // JavaScript function to sort the table based on the clicked column
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
