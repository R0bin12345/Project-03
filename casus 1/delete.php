<?php
// auteur: ishika
// functie: verwijder een docent op basis van de docent
include 'functions.php';

// Haal bier uit de database
if(isset($_GET['ziekmedingen'])){

    // test of insert gelukt is
    $ziekmedingen = $_GET['ziekmedingen'];
    $result = deleteZiekmelding($ziekmedingen);

    if ($result) {
        echo '<script>alert("Bier met ziekmedingen: ' . $ziekmedingen . ' is verwijderd")</script>';
        echo "<script> location.replace('ziekmeldingen.php'); </script>";
    } else {
        echo '<script>alert("Bier met ziekmedingen: ' . $ziekmedingen . ' is NIET verwijderd")</script>';
    }
}
?>