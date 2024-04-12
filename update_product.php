<?php
    // functie: update product
    // auteur: Wigmans

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateProduct($_POST) == true){
            echo "<script>alert('Product is gewijzigd')</script>";
        } else {
            echo '<script>alert("Product is NIET gewijzigd")</script>';
        }
    }

    // T// Test of id is meegegeven in the URL
if(isset($_GET['productcode'])){  
  // Haal alle info van de betreffende id $_GET['productcode']
  $productcode = $_GET['productcode'];
  $row = getProduct($productcode);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Product</title>
</head>
<body>
  <h2>Wijzig Product</h2>
  <form method="post">
    
  <input type="hidden"  name="productcode" required value="<?php echo $row['productcode']; ?>"><br>

    <label for="merk">Merk:</label>
    <input type="text" id="merk" name="merk" required value="<?php echo $row['merk']; ?>"><br>

    <label for="type">naam:</label>
    <input type="text" id="type" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="prijs">Prijs:</label>
    <input type="number" id="prijs" name="prijs" required value="<?php echo $row['prijs']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='crud_product.php'>Home</a>
</body>
</html>

<?php
    } else {
        "Geen id opgegeven<br>";
    }
?>