<?php include "db.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <?php
        // Retrieve employee details from the database
        $sql = "SELECT * FROM employee";
        $result = mysqli_query($conn, $sql);

        // Check if there are any rows returned
        if ($result && mysqli_num_rows($result) > 0) {
            // Loop through each row and display employee details
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="employee">';
                echo '<h2>Employee ID: ' . $row['emp_id'] . '</h2>';
                echo '<p>Name: ' . $row['emp_name'] . '</p>';
                echo '<p>Position: ' . $row['emp_post'] . '</p>';
                echo '<p>gender: ' . $row['emp_gender'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No employee details found.</p>';
        }
        ?>
    </div>
    <a href="index.php" class="back-to-home">Back to Home</a>
</body>
</html>
