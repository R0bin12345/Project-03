<?php
// Auteur: Robin
// Functie: Verwijder cijfer uit de database

// Connecteer met de database
include "connect.php";

// Controleer of er een klantcode is opgegeven in de URL
if (isset($_GET['klantcode']) && is_numeric($_GET["klantcode"])) {
    // Ontvang de klantcode van de URL
    $klantcode = $_GET['klantcode'];

    $query = $db->prepare("DELETE FROM klant WHERE klantcode=:klantcode");
    $query->bindParam(":klantcode", $klantcode, PDO::PARAM_INT);

    if ($query->execute()) {
        echo "Record succesvol verwijderd.";
    } else {
        echo "Er is een fout opgetreden tijdens het verwijderen van het record.";
    }
} else {
    echo "Ongeldige invoer.";
}

// Redirect je terug naar de hoofdpagina
header("Location: index.php");
exit;
?>
