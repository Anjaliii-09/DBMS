<?php
// Include the database connection file
include "db.php";

// Retrieve manager messages from the manager_messages table
$sql = "SELECT * FROM manager_messages ORDER BY timestamp DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Check if there are any messages
if (mysqli_num_rows($result) > 0) {
    echo "<h1>Manager Messages</h1>";
    echo "<ul>";
    // Display each message
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["message"] . " - " . $row["timestamp"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No messages for the manager.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <h1>All the trigger message are here</h1>

    <ul>
        <?php
        // Check if there are any messages
        if (mysqli_num_rows($result) > 0) {
            // Display each message
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row["message"] . " - " . $row["timestamp"] . "</li>";
            }
        } else {
            echo "<li>No messages for the manager.</li>";
        }
        ?>
    </ul>
</body>
</html>

<?php
// Free the result set
mysqli_free_result($result);

// Close the database connection
mysqli_close($conn);
?>

<?php
// Include the database connection file
include "db.php";

// Add the trigger for order addition notification
$triggerSql = "
    CREATE TRIGGER order_added_trigger
    AFTER INSERT ON orders
    FOR EACH ROW
    BEGIN
        DECLARE employee_name VARCHAR(255);
        SELECT CONCAT('New order added by employee: ', emp_id) INTO employee_name FROM employees WHERE emp_id = NEW.emp_id;
        INSERT INTO manager_messages (message) VALUES (employee_name);
    END;
";

// Execute the trigger creation query
if (mysqli_query($conn, $triggerSql)) {
    echo "Trigger created successfully.";
} else {
    echo "Error creating trigger: " . mysqli_error($conn);
}
?>
<a href="index.html">back to home<a>