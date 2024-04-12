<?php
// Author: Wigmans
// Function: General functions for reuse

include_once "config.php";

function connectDb(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webshop";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        //echo "Connected successfully";
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

// Select the data from the specified table
function getData($table){
    // Connect to the database
    $conn = connectDb();

    // Select data from the specified table using prepared statement
    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

// Select the row with the specified product code from the product table
function getProduct($productcode){
    // Connect to the database
    $conn = connectDb();

    // Select data from the product table using prepared statement
    $sql = "SELECT * FROM product WHERE productcode = :productcode";
    $query = $conn->prepare($sql);
    $query->execute([':productcode'=>$productcode]);
    $result = $query->fetch();

    return $result;
}

function ovzProduct(){
    // Get all product records from the product table
    $result = getData("product");
    
    // Print table
    printTable($result);
}

// Function 'printTable' prints an HTML table with data from $result.
function printTable($result){
    // Initialize the table HTML string
    $table = "<table style='border-collapse: collapse; width: 100%; color: white;'>";

    // Print header table
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>" . $header . "</th>";   
    }

    // Print each row of the table
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // Print each cell
        foreach ($row as $cell) {
            $table .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px; color: white;'>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";

    // Print the table
    echo $table;
}

function crudProduct(){
    // Menu-item insert
    $txt = "<h1></h1><nav><a href='insert_product.php'>Toevoegen nieuw product</a></nav><br>";
    echo $txt;

    // Get all product records from the product table
    $result = getData("product");

    // Print table
    printCrudProduct($result);
}

// Function 'printCrudProduct' prints an HTML table with data from $result 
// and edit and delete buttons.
function printCrudProduct($result){
    // Initialize the table HTML string
    $table = "<table style='border-collapse: collapse; width: 100%; color: white;'>";

    // Print table header
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        // Skip printing 'productcode' column
        if ($header !== 'productcode') {
            $table .= "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>" . $header . "</th>";   
        }
    }
    // Print action column headers
    $table .= "<th colspan=2 style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Actions</th>";
    $table .= "</tr>";

    // Print each row
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // Print each cell
        foreach ($row as $header => $cell) {
            // Skip printing 'productcode' column
            if ($header !== 'productcode') {
                $table .= "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px; color: white;'>" . $cell . "</td>";  
            }
        }
        
        // Edit button
        $table .= "<td>
            <form method='post' action='update_product.php?productcode=$row[productcode]' >       
                <button>Edit</button>	 
            </form>
            </td>";
    
        // Delete button
        $table .= "<td>
            <form method='post' action='delete_product.php?productcode=$row[productcode]' >       
                <button>Delete</button>	 
            </form>
            </td>";
    
        $table .= "</tr>";
    }
    $table.= "</table>";

    // Print the table
    echo $table;
}

function updateProduct($row){
    
    // Make database connection
    $conn = connectDb();

    // Prepare query 
    $sql = "UPDATE product SET 
        naam = :naam, 
        merk = :merk, 
        prijs = :prijs
    WHERE productcode = :productcode
    ";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Execute query
    $stmt->execute([
        ':naam'=>$row['naam'],
        ':merk'=>$row['merk'],
        ':prijs'=>$row['prijs'],
        ':productcode'=>$row['productcode']
    ]);

    // Check if the database action was successful
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function insertProduct($post){
    // Make database connection
    $conn = connectDb();

    // Prepare query 
    $sql =
        "INSERT INTO product (naam, merk, prijs)
        VALUES (:naam, :merk, :prijs)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Execute query
    $stmt->execute([
        ':naam' => $post['naam'],
        ':merk' => $post['merk'],
        ':prijs' => $post['prijs']
    ]);

    // Check if the database action was successful
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

function deleteProduct($productcode){

    // Connect to the database
    $conn = connectDb();
    
    // Prepare query
    $sql = "DELETE FROM product WHERE productcode = :productcode"; // Corrected SQL query
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    
    // Execute query
    $stmt->execute([':productcode' => $productcode]);
    
    // Check if the database action was successful
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function getKlant($klantcode){
    // Maak verbinding met de database
    $conn = connectDb();

    // Selecteer gegevens uit de klantentabel met behulp van een prepared statement
    $sql = "SELECT * FROM klant WHERE klantcode = :klantcode";
    $query = $conn->prepare($sql);
    $query->execute([':klantcode'=>$klantcode]);
    $result = $query->fetch();

    return $result;
}

// Define the insertKlant function to insert a new customer into the database
function insertKlant($postData) {
    // Connect to the database
    $conn = connectDb();

    // Prepare query 
    $sql =
        "INSERT INTO klant (klantnaam, klantadres, klantplaats, klantcontact, klantpostcode, klantcountry)
        VALUES (:klantnaam, :klantadres, :klantplaats, :klantcontact, :klantpostcode, :klantcountry)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Execute query
    $stmt->execute([
        ':klantnaam' => $postData['naam'],
        ':klantadres' => $postData['adres'],
        ':klantplaats' => $postData['plaats'],
        ':klantcontact' => $postData['contact'],
        ':klantpostcode' => $postData['postcode'],
        ':klantcountry' => $postData['land']
    ]);

    // Check if the database action was successful
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

// Define the updateKlant function to update an existing customer in the database
function updateKlant($postData) {
    // Connect to the database
    $conn = connectDb();

    // Prepare query 
    $sql =
        "UPDATE klant SET 
        klantnaam = :klantnaam, 
        klantadres = :klantadres, 
        klantplaats = :klantplaats,
        klantcontact = :klantcontact,
        klantpostcode = :klantpostcode,
        klantcountry = :klantcountry
        WHERE klantcode = :klantcode";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Execute query
    $stmt->execute([
        ':klantnaam' => $postData['naam'],
        ':klantadres' => $postData['adres'],
        ':klantplaats' => $postData['plaats'],
        ':klantcontact' => $postData['contact'],
        ':klantpostcode' => $postData['postcode'],
        ':klantcountry' => $postData['land'],
        ':klantcode' => $postData['klantcode']
    ]);

    // Check if the database action was successful
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

// Define the insertBestelling function to insert a new order into the database
function insertBestelling($postData) {
    // Connect to the database
    $conn = connectDb();

    // Prepare query 
    $sql =
        "INSERT INTO bestelling (klantcode, productcode, aantal)
        VALUES (:klantcode, :productcode, :aantal)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Execute query
    $stmt->execute([
        ':klantcode' => $postData['klant'],
        ':productcode' => $postData['productcode'],
        ':aantal' => $postData['aantal']
    ]);

    // Check if the database action was successful
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

// Select the row with the specified order code from the order table
function getBestelling($bestelcode){
    // Connect to the database
    $conn = connectDb();

    // Select data from the order table using prepared statement
    $sql = "SELECT * FROM bestelling WHERE bestelcode = :bestelcode";
    $query = $conn->prepare($sql);
    $query->execute([':bestelcode' => $bestelcode]);
    $result = $query->fetch();

    return $result;
}

// Define the updateBestelling function to update an existing order in the database
function updateBestelling($postData) {
    // Connect to the database
    $conn = connectDb();

    // Prepare query 
    $sql =
        "UPDATE bestelling SET 
        klantcode = :klantcode, 
        productcode = :productcode, 
        aantal = :aantal
    WHERE bestelcode = :bestelcode";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    // Execute query
    $stmt->execute([
        ':klantcode' => $postData['klant'],
        ':productcode' => $postData['productcode'],
        ':aantal' => $postData['aantal'],
        ':bestelcode' => $postData['bestelcode']
    ]);

    // Check if the database action was successful
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

?>

