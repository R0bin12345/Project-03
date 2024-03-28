<?php
// Databaseverbinding
try {
    $db = new PDO("mysql:host=localhost;dbname=webshop", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindingsfout: " . $e->getMessage());
}
?>
