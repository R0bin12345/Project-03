<?php
    // functie: formulier en database insert klant
    // auteur: Wigmans

    echo "<h1>Voeg klant toe</h1>";

    require_once('functions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertKlant($_POST) == true){
            echo "<script>alert('Klant is toegevoegd')</script>";
        } else {
            echo '<script>alert("Klant is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br>

        <label for="adres">Adres:</label>
        <input type="text" id="adres" name="adres" required><br>

        <label for="plaats">Plaats:</label>
        <input type="text" id="plaats" name="plaats" required><br>

        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" required><br>

        <label for="postcode">Postcode:</label>
        <input type="text" id="postcode" name="postcode" required><br>

        <label for="land">Land:</label>
        <input type="text" id="land" name="land" required><br>

        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
    <button><a href='index.php'>Home</a></button> 
    </body>
</html>
