<?php
// Include the database connection file
include "db.php";

// Check if the ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID parameter to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // SQL query to retrieve the customer data based on the provided ID
    $sql = "SELECT * FROM customers WHERE customer_number = '$id'";
    
    // Execute the SQL query
    $result = mysqli_query($conn, $sql);
    
    // Check if the query was executed successfully
    if ($result) {
        // Check if data exists for the provided ID
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $customer_number = $row["customer_number"];
            $customer_name = $row["customer_name"];
            $customer_order = $row["customer_order"];
        } else {
            echo "No customer found with the provided ID.";
            exit;
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        exit;
    }
} else {
    echo "No ID parameter provided.";
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_name = $_POST["customer_name"];
    $customer_order = $_POST["customer_order"];

    // SQL query to update customer data in the customers table
    $sql = "UPDATE customers SET customer_name='$customer_name', customer_order='$customer_order' WHERE customer_number='$id'";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    // Check if the query was executed successfully
    if ($result) {
        echo "customer updated successfully.";
    } else {
        echo "Error updating customer: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit customer</title>
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
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit customer</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $id; ?>" method="post">
        <label for="customer_number">customer Number:</label>
        <input type="text" id="customer_number" name="customer_number" value="<?php echo $customer_number; ?>" readonly><br>
        <label for="customer_name">customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" required><br>
        <label for="customer_order">customer Order:</label>
        <input type="text" id="customer_order" name="customer_order" value="<?php echo $customer_order; ?>" required><br>
        <input type="submit" value="Update customer">
    </form>
</div>
<a href="customer.php" class="back-to-home">Back to Home</a>
</body>
</html>
