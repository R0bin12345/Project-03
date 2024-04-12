<?php
    // Functie: Update bestelling
    // Auteur: Wigmans

    require_once('functions.php');

    // Test of de wijzig-knop is ingedrukt 
    if(isset($_POST['btn_wzg'])){
        // Test of de update is gelukt
        if(updateBestelling($_POST) == true){
            echo "<script>alert('Bestelling is gewijzigd')</script>";
        } else {
            echo '<script>alert("Bestelling is NIET gewijzigd")</script>';
        }
    }

    // Test of bestelcode is meegegeven in de URL
    if(isset($_GET['bestelcode'])){  
        // Haal alle informatie op van de betreffende bestelcode
        $bestelcode = $_GET['bestelcode'];
        $row = getBestelling($bestelcode);

        // Controleer of er een bestelling is gevonden voordat je klantinformatie probeert op te halen
        if($row) {
            // Haal alle klanten op uit de database om weer te geven in het dropdown-menu
            $klanten = getData("klant");
        } else {
            // Toon een foutmelding of redirect naar een andere pagina
            echo "Bestelling niet gevonden!";
            exit; // Stop de scriptuitvoering om verdere fouten te voorkomen
        }
    } else {
        // Toon een foutmelding of redirect naar een andere pagina
        echo "Geen bestelcode opgegeven!";
        exit; // Stop de scriptuitvoering om verdere fouten te voorkomen
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Bestelling</title>
</head>
<body>
  <h2>Wijzig Bestelling</h2>
  <form method="post">
    
  <input type="hidden"  name="bestelcode" required value="<?php echo isset($row['bestelcode']) ? $row['bestelcode'] : ''; ?>"><br>

    <label for="klant">Klant:</label>
    <select id="klant" name="klant" required>
        <?php foreach ($klanten as $klant) : ?>
            <option value="<?php echo $klant['klantcode']; ?>" <?php echo (isset($row['klantcode']) && $klant['klantcode'] == $row['klantcode']) ? 'selected' : ''; ?>>
                <?php echo $klant['klantnaam']; ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="productcode">Productcode:</label>
    <input type="text" id="productcode" name="productcode" required value="<?php echo isset($row['productcode']) ? $row['productcode'] : ''; ?>"><br>

    <label for="aantal">Aantal:</label>
    <input type="text" id="aantal" name="aantal" required value="<?php echo isset($row['aantal']) ? $row['aantal'] : ''; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index1.php'>Terug naar bestellingenlijst</a>
</body>
</html>
