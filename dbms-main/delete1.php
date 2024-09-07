<?php
include "db.php";

// Check if an item parameter is provided in the URL
if (isset($_GET['item'])) {
    $item = $_GET['item'];

    // Delete the item from the database
    $sql_delete = "DELETE FROM inventory WHERE item='$item'";
    if (mysqli_query($conn, $sql_delete)) {
        // Redirect to inventory.php after successful deletion
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
} else {
    // Redirect to inventory.php if no item is provided
    header("Location: inventory.php");
    exit();
}

mysqli_close($conn); // Close the database connection
?>
