<?php
// Include the database connection file
include "db.php";

// Check if the ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // SQL query to delete the customer based on the provided ID
    $sql = "DELETE FROM customers WHERE customer_number = '$id'";
    
    // Execute the SQL query
    $result = mysqli_query($conn, $sql);
    
    // Check if the query was executed successfully
    if ($result) {
        echo "customer deleted successfully.";
    } else {
        echo "Error deleting customer: " . mysqli_error($conn);
    }
} else {
    echo "No ID parameter provided.";
}
?>
<a href="customer.php" class="back-to-home">Back to Home</a>