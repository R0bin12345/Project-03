<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // Zorg ervoor dat je een connect.php bestand hebt voor de databaseverbinding
    // Haal de ingevoerde gegevens op en saniteer deze
    $klantnaam = htmlspecialchars($_POST['klantnaam']);
    $klantadres = htmlspecialchars($_POST['klantadres']);
    $klantplaats = htmlspecialchars($_POST['klantplaats']);
    $klantcontact = htmlspecialchars($_POST['klantcontact']);
    $klantpostcode = htmlspecialchars($_POST['klantpostcode']);
    $klantcountry = htmlspecialchars($_POST['klantcountry']);
    // Controleer of de gegevens geldig zijn
    if ($klantnaam && $klantadres && $klantplaats && $klantcontact && $klantpostcode && $klantcountry) {
        // Bereid de SQL-query voor om het nieuwe klantadres in te voegen
        $query = $db->prepare("INSERT INTO klant (klantnaam, klantadres, klantplaats, klantcontact, klantpostcode, klantcountry) VALUES (:klantnaam, :klantadres, :klantplaats, :klantcontact, :klantpostcode, :klantcountry)");

        // Bind de waarden aan de parameters
        $query->bindParam(':klantnaam', $klantnaam);
        $query->bindParam(':klantadres', $klantadres);
        $query->bindParam(':klantplaats', $klantplaats);
        $query->bindParam(':klantcontact', $klantcontact);
        $query->bindParam(':klantpostcode', $klantpostcode);
        $query->bindParam(':klantcountry', $klantcountry);
        // Voer de query uit
        if ($query->execute()) {
            echo "Nieuw klantadres succesvol toegevoegd.</br><a href='index.php'>Ga terug naar het systeem</a>";
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
    <title>Nieuw klantadres Toevoegen</title>
</head>
<body>

<h2>Nieuw klantadres Invoeren</h2>

<form action="invoeren.php" method="post">
    <label for="klantnaam">klantnaam:</label><br>
    <input type="text" id="klantnaam" name="klantnaam" required><br>
    
    <label for="klantadres">klantadres:</label><br>
    <input type="text" id="klantadres" name="klantadres" required><br>

    <label for="klantplaats">klantplaats:</label><br>
    <input type="text" id="klantplaats" name="klantplaats" required><br>

    <label for="klantcontact">klantcontact:</label><br>
    <input type="text" id="klantcontact" name="klantcontact" required><br><br>
    
    <label for="klantpostcode">klantpostcode:</label><br>
    <input type="text" id="klantpostcode" name="klantpostcode" required><br>

    <label for="klantcountry">klantcountry:</label><br>
    <input type="text" id="klantcountry" name="klantcountry" required><br><br>

    <input type="submit" value="Toevoegen">
</form>
</body>
</html>
