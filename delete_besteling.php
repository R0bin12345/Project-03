<?php
// Include the connect.php file to establish a database connection
include 'connect.php';

// Check if bestelcode is set in the URL parameters
if (isset($_GET['bestelcode'])) {
    // Prepare query to delete a bestelling from the bestelling table based on bestelcode
    $query = $db->prepare("DELETE FROM bestelling WHERE bestelcode = :bestelcode");
    // Bind the bestelcode parameter
    $query->bindParam(':bestelcode', $_GET['bestelcode']);
    // Execute the query
    if ($query->execute()) {
        // Redirect to the bestellingen page after successful deletion
        header("Location: index1.php");
        exit(); // Stop further execution of the script
    } else {
        // If deletion fails, display an error message
        echo "Error deleting bestelling.";
    }
} else {
    // If bestelcode is not set in the URL parameters, display an error message
    echo "Bestelcode not specified.";
}
?>
