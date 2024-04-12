<?php
// auteur: ishika
// functie: bewerk een ziekmelding op basis van de ziekmelding
include 'functions.php';

$ziekmelding = []; // Initialiseren van $ziekmelding

// Haal de ziekmelding uit de database op basis van de meegegeven naam
if(isset($_GET['naam'])){
    $naam = $_GET['naam'];
    $ziekmelding = getZiekmeldingByName($conn, $naam); // Correcte toewijzing van $ziekmelding
}

// Bewerk ziekmelding in de database
if(isset($_POST['submit'])){
    $naam = $_POST['naam'];
    $reden = $_POST['reden'];
    $afdeling = $_POST['afdeling'];

    $result = updateZiekmelding($naam, $reden, $afdeling);

    if ($result) {
        echo '<script>alert("Ziekmelding met naam: ' . $naam . ' is bijgewerkt")</script>';
        echo "<script> location.replace('ziekmeldingen.php'); </script>";
    } else {
        echo '<script>alert("Ziekmelding met naam: ' . $naam . ' kon niet worden bijgewerkt")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziekmelding Bewerken</title>
</head>
<body>
    <h1>Ziekmelding Bewerken</h1>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="naam">Naam:</label><br>
        <input type="text" id="naam" name="naam" value="<?php echo isset($ziekmelding['naam']) ? $ziekmelding['naam'] : ''; ?>"> <br>
        <label for="reden">Reden:</label><br>
        <input type="text" id="reden" name="reden" value="<?php echo isset($ziekmelding['reden']) ? $ziekmelding['reden'] : ''; ?>" required><br> <!-- Controleren of $ziekmelding['reden'] is ingesteld -->
        <label for="afdeling">Afdeling (optioneel):</label><br>
        <input type="text" id="afdeling" name="afdeling" value="<?php echo isset($ziekmelding['afdeling']) ? $ziekmelding['afdeling'] : ''; ?>"><br> <!-- Controleren of $ziekmelding['afdeling'] is ingesteld -->
        <input type="submit" name="submit" value="Bijwerken">
    </form>
</body>
</html>
