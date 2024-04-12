<?php
// Functie: formulier en database insert bestelling
// Auteur: Wigmans
echo "<h1>Voeg bestelling toe</h1>";
require_once('functions.php');

// Haal alle klanten op uit de database om weer te geven in het dropdown-menu
$klanten = getData("klant");

// Haal alle producten op uit de database om weer te geven in het dropdown-menu
$producten = getData("product");
?>
<html>
<body>
<form method="post">
<label for="klant">Klant:</label>
<select id="klant" name="klant" required>
<?php foreach ($klanten as $klant) : ?>
<option value="<?php echo $klant['klantcode']; ?>"><?php echo $klant['klantnaam']; ?></option>
<?php endforeach; ?>
</select><br>
<label for="productcode">Product:</label>
<select id="productcode" name="productcode" required>
<?php foreach ($producten as $product) : ?>
<option value="<?php echo $product['productcode']; ?>"><?php echo $product['naam']; ?></option>
<?php endforeach; ?>
</select><br>
<label for="aantal">Aantal:</label>
<input type="text" id="aantal" name="aantal" required><br>
<input type="submit" name="btn_ins" value="Insert">
</form>
<br><br>
<button><a href='index1.php'>Home</a></button>
</body>
</html>

<?php
// Test of er op de insert-knop is gedrukt
if(isset($_POST) && isset($_POST['btn_ins'])) {
   // Test of insert gelukt is
   if(insertBestelling($_POST) == true) {
       echo "<script>alert('Bestelling is toegevoegd')</script>";
   } else {
       echo '<script>alert("Bestelling is NIET toegevoegd")</script>';
   }
}
?>
