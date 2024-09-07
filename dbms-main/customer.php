<?php
// Include the database connection file
include "db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_number = $_POST["customer_number"];
    $customer_name = $_POST["customer_name"];
    $customer_order = $_POST["customer_order"];

    // SQL query to insert customer data into the customers table
    $sql = "INSERT INTO customers (customer_number, customer_name, customer_order) VALUES ('$customer_number', '$customer_name', '$customer_order')";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if the query was executed successfully
    if ($result) {
        echo "customer added successfully.";
    } else {
        echo "Error adding customer: " . mysqli_error($conn);
    }
}

// Retrieve data from the customers table
$sql = "SELECT * FROM viewname";
$result = mysqli_query($conn, $sql);

// Check for database connection and query errors
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>customer Number</th><th>customer Name</th><th>customer Order</th><th>Action</th></tr>";
    // Loop through each row and display customer details
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        // Output customer details
        echo "<td>" . $row["Column1"] . "</td>";
        echo "<td>" . $row["Column2"] . "</td>";
        // Add edit and delete options
        echo "<td><a href='edit.php?id=" . $row["Column1"] . "'>Edit</a> | <a href='delete.php?id=" . $row["Column1"] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}


// Free the result set
mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customer Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>customer Information</h1>

    <div>
        <h2>Add customer</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="customer_number">customer Number:</label>
            <input type="text" id="customer_number" name="customer_number" required><br><br>
            <label for="customer_name">customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required><br><br>
            <label for="customer_order">customer Order:</label>
            <input type="text" id="customer_order" name="customer_order" required><br><br>
            <input type="submit" value="Add customer">
        </form>
    </div>
    <a href="index.php" class="back-to-home">Back to Home</a>
</div>

</body>
</html>
