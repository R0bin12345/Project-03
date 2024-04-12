<?php
    // functie: update klant
    // auteur: Wigmans

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateKlant($_POST) == true){
            echo "<script>alert('Klant is gewijzigd')</script>";
        } else {
            echo '<script>alert("Klant is NIET gewijzigd")</script>';
        }
    }

    // Test of id is meegegeven in de URL
    if(isset($_GET['klantcode'])){  
        // Haal alle info van de betreffende id $_GET['klantcode']
        $klantcode = $_GET['klantcode'];
        $row = getKlant($klantcode);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Klant</title>
</head>
<body>
  <h2>Wijzig Klant</h2>
  <form method="post">
    
  <input type="hidden"  name="klantcode" required value="<?php echo $row['klantcode']; ?>"><br>

    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required value="<?php echo $row['klantnaam']; ?>"><br>

    <label for="adres">Adres:</label>
    <input type="text" id="adres" name="adres" required value="<?php echo $row['klantadres']; ?>"><br>

    <label for="plaats">Plaats:</label>
    <input type="text" id="plaats" name="plaats" required value="<?php echo $row['klantplaats']; ?>"><br>

    <label for="contact">Contact:</label>
    <input type="text" id="contact" name="contact" required value="<?php echo $row['klantcontact']; ?>"><br>

    <label for="postcode">Postcode:</label>
    <input type="text" id="postcode" name="postcode" required value="<?php echo $row['klantpostcode']; ?>"><br>

    <label for="land">Land:</label>
    <input type="text" id="land" name="land" required value="<?php echo $row['klantcountry']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index.php'>Terug naar klantenlijst</a>
</body>
</html>
