<?php
    // functie: formulier en database insert product
    // auteur: Wigmans

    echo "<h1>Insert Product</h1>";

    require_once('functions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertProduct($_POST) == true){
            echo "<script>alert('Product is toegevoegd')</script>";
        } else {
            echo '<script>alert("Product is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br>

        <label for="merk">Merk:</label>
        <input type="text" id="merk" name="merk" required><br>

        <label for="prijs">Prijs:</label>
        <input type="number" id="prijs" name="prijs" required><br>

        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
    <button><a href='crud_product.php'>Home</a></button> 
    </body>
</html>