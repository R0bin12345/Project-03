<?php
// auteur: Wigmans
// functie: verwijder een bier op basis van de productcode
include 'functions.php';

// Haal fiets uit de database
if(isset($_GET['productcode'])){

    // test of verwijderen gelukt is
    if(deleteProduct($_GET['productcode']) == true){
        echo '<script>alert("productcode: ' . $_GET['productcode'] . ' is verwijderd")</script>';
        echo "<script> location.replace('crud_product.php'); </script>";
    } else {
    echo '<script>alert("Product is NIET verwijderd")</script>';
      }}
?>

<html>




</html>