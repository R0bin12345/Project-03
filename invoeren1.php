<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect1.php'; // Zorg ervoor dat je een connect1.php bestand hebt voor de databaseverbinding
    // Haal de ingevoerde gegevens op en saniteer deze
    $bestel = htmlspecialchars($_POST['bestel']);
    $productcode = htmlspecialchars($_POST['productcode']);
    $aantal = filter_input(INPUT_POST, 'aantal', FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]); // Zorg ervoor dat aantal een positief geheel getal is
    // Controleer of de gegevens geldig zijn
    if ($bestel !== false && $productcode !== false && $aantal !== false) {
        // Bereid de SQL-query voor om het nieuwe product in te voegen
        $query = $db->prepare("INSERT INTO bestelling (bestel, productcode, aantal) VALUES (:bestel, :productcode, :aantal)");

        // Bind de waarden aan de parameters
        $query->bindParam(':bestel', $bestel);
        $query->bindParam(':productcode', $productcode);
        $query->bindParam(':aantal', $aantal);
        // Voer de query uit
        if ($query->execute()) {
            echo "Nieuw product succesvol toegevoegd.</br><a href='index.php'>Ga terug naar het systeem</a>";
        } else {
            echo "Er is een fout opgetreden bij het toevoegen, probeer opnieuw!";
        }
    } else {
        echo "Ongeldige invoer.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nieuw product Toevoegen</title>
</head>
<body>

<h2>Nieuw product Invoeren</h2>

<form action="invoeren1.php" method="post">
    <label for="bestel">bestel:</label><br>
    <input type="text" id="bestel" name="bestel" required><br>
    
    <label for="productcode">Productcode:</label><br>
    <input type="text" id="productcode" name="productcode" required><br>

    <label for="aantal">Aantal:</label><br>
    <input type="number" id="aantal" name="aantal" min="1" required><br>

    <input type="submit" value="Toevoegen">
</form>
</body>
</html>
