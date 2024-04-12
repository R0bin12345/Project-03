<?php
// Auteur: Robin
// Functie: Verwijder bestelling uit de database

// Connecteer met de database
include "connect1.php";

// Controleer of er een bestelcode is opgegeven in de URL
if (isset($_GET['bestelcode']) && is_numeric($_GET["bestelcode"])) {
    // Ontvang de bestelcode van de URL
    $bestelcode = $_GET['bestelcode'];

    $query = $db->prepare("DELETE FROM bestelling WHERE bestelcode=:bestelcode");
    $query->bindParam(":bestelcode", $bestelcode, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "Record succesvol verwijderd.";
    } else {
        echo "Er is een fout opgetreden tijdens het verwijderen van het record.";
    }
} else {
    echo "Ongeldige invoer.";
}

// Redirect je terug naar de hoofdpagina
header("Location: index1.php");
exit;
?>
