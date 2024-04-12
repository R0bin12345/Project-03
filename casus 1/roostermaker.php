<?php
// Databaseverbinding
$servername = "localhost";
$username = "root";
$password = "";
$database = "school_db";

$conn = new mysqli($servername, $username, $password, $database);

// Controleren op verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inclusie van de functies
include 'functions.php';

// Toevoegen van een ziekmelding
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $reden = $_POST['reden'];
    $datum = date('Y-m-d'); // Huidige datum
    $afdeling = isset($_POST['afdeling']) ? $_POST['afdeling'] : null;
    addZiekmelding($conn, $naam, $reden, $datum, $afdeling);
}

// Verwijderen van een ziekmelding
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $naam = $_POST['delete'];
    deleteZiekmelding($conn, $naam);
}

// Inzien van alle ziekmeldingen
$ziekmeldingen = getZiekmeldingen($conn);
?>

<!-- HTML voor de interface -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziekmeldingen</title>
</head>
<body>
    <h1>Ziekmeldingen</h1>

    <!-- Formulier om een ziekmelding toe te voegen -->
    <h2>Ziekmelding toevoegen</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="naam">Naam:</label><br>
        <input type="text" id="naam" name="naam" required><br>
        <label for="reden">Reden:</label><br>
        <input type="text" id="reden" name="reden" required><br>
        <label for="afdeling">Afdeling (optioneel):</label><br>
        <input type="text" id="afdeling" name="afdeling"><br>
        <input type="submit" name="submit" value="Toevoegen">
    </form>

    <!-- Lijst van alle ziekmeldingen -->
    <h2>Ziekmeldingenlijst</h2>
    <ul>
        <?php foreach ($ziekmeldingen as $melding) { ?>
            <li>
                <?php echo $melding['naam'] . " - " . $melding['reden'] . " - " . $melding['datum'] . " - " . $melding['afdeling']; ?>
                <!-- Formulier om een ziekmelding te verwijderen -->
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <input type="hidden" name="delete" value="<?php echo $melding['naam']; ?>">
                    <input type="submit" value="Verwijderen">
                </form>
                <!-- Formulier om een ziekmelding bij te werken -->
                <form method="post" action="update.php">
                    <input type="hidden" name="naam" value="<?php echo $melding['naam']; ?>">
                    <input type="submit" value="Bijwerken">
                </form>
            </li>
        <?php } ?>
    </ul>
</body>
</html>

<?php
// Databaseverbinding sluiten
$conn->close();
?>
