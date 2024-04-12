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

// Functie om alle ziekmeldingen op te halen
function getZiekmeldingen($conn) {
    $sql = "SELECT * FROM ziekmeldingen";
    $result = $conn->query($sql);
    $ziekmeldingen = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ziekmeldingen[] = $row;
        }
    }
    return $ziekmeldingen;
}

// Inzien van alle ziekmeldingen
$ziekmeldingen = getZiekmeldingen($conn);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ziekmeldingenlijst</title>
</head>
<body>
    <h1>Ziekmeldingenlijst</h1>

    <ul>
        <?php foreach ($ziekmeldingen as $melding) { ?>
            <li><?php echo $melding['naam'] . " - " . $melding['reden'] . " - " . $melding['datum'] . " - " . $melding['afdeling']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>

<?php
// Databaseverbinding sluiten
$conn->close();
?>
