<?php
// Functie om ziekmelding toe te voegen
function addZiekmelding($conn, $naam, $reden, $datum, $afdeling = null) {
    $naam = mysqli_real_escape_string($conn, $naam);
    $reden = mysqli_real_escape_string($conn, $reden);
    $datum = mysqli_real_escape_string($conn, $datum);
    $afdeling = $afdeling ? mysqli_real_escape_string($conn, $afdeling) : null;

    $sql = "INSERT INTO ziekmeldingen (naam, reden, datum, afdeling) VALUES ('$naam', '$reden', '$datum', '$afdeling')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
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

// Functie om een ziekmelding te verwijderen
function deleteZiekmelding($conn, $naam) {
    $naam = mysqli_real_escape_string($conn, $naam); // Voorkom SQL-injectie
    $sql = "DELETE FROM ziekmeldingen WHERE naam = '$naam'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Functie om een ziekmelding bij te werken
function updateZiekmelding($conn, $naam, $reden, $datum, $afdeling = null) {
    $naam = mysqli_real_escape_string($conn, $naam);
    $reden = mysqli_real_escape_string($conn, $reden);
    $datum = mysqli_real_escape_string($conn, $datum);
    $afdeling = $afdeling ? mysqli_real_escape_string($conn, $afdeling) : null;

    $sql = "UPDATE ziekmeldingen SET reden='$reden', datum='$datum', afdeling='$afdeling' WHERE naam='$naam'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
