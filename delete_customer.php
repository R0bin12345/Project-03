<?php
// Include the connect.php file to establish a database connection
include 'connect.php';

// Check if klantcode is set in the URL parameters
if (isset($_GET['klantcode'])) {
    // Begin transaction
    $db->beginTransaction();

    try {
        // Prepare query to delete orders related to the customer from the bestelling table based on klantcode
        $query_orders = $db->prepare("DELETE FROM bestelling WHERE bestel = :klantcode");
        // Bind the klantcode parameter
        $query_orders->bindParam(':klantcode', $_GET['klantcode']);
        // Execute the query to delete orders
        $query_orders->execute();

        // Prepare query to delete the customer from the klant table based on klantcode
        $query_customer = $db->prepare("DELETE FROM klant WHERE klantcode = :klantcode");
        // Bind the klantcode parameter
        $query_customer->bindParam(':klantcode', $_GET['klantcode']);
        // Execute the query to delete the customer
        $query_customer->execute();

        // Commit transaction if everything is successful
        $db->commit();

        // Redirect to the klantenlijst page after successful deletion
        header("Location: index.php");
        exit(); // Stop further execution of the script
    } catch (PDOException $e) {
        // Rollback transaction and display error message if any error occurs
        $db->rollBack();
        echo "Error: " . $e->getMessage();
    }
} else {
    // If klantcode is not set in the URL parameters, display an error message
    echo "Klantcode not specified.";
}
?>
