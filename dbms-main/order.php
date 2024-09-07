<?php
// Include the database connection file
include "db.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_name = $_POST["customer_name"];
    $emp_id = $_POST["emp_id"]; // Updated to emp_id

    // SQL query to insert customer data into the orders table using prepared statement
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, emp_id) VALUES (?, ?)");

    $stmt->bind_param("si", $customer_name, $emp_id); // Updated to si (string, integer)
    $stmt->execute();

    // Check if the query was executed successfully
    if ($stmt->affected_rows > 0) {
        echo json_encode(array("status" => "success", "message" => "Order added successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error adding order: " . $stmt->error));
    }

    // Close statement
    $stmt->close();
}

// Fetch existing orders from the database
$sql = "SELECT order_id, customer_name, emp_id FROM orders"; // Adjusted to match table columns
$result = mysqli_query($conn, $sql);
$orders = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-bottom: 20px;
        }
        
        h1 {
            margin: 0;
        }
        
        main {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .order-container {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        
        h2 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.5rem;
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        
        .order-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .order-form input[type="text"],
        .order-form select,
        .submit-order-btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .submit-order-btn {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }
        
        .submit-order-btn:hover {
            background-color: #555;
        }
        
        .back-to-home {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .back-to-home:hover {
            background-color: #555;
        }
        
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
        
        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
<header>
    <h1>Orders</h1>
</header>
<main>
    <div class="order-container">
        <h2>Existing Orders</h2>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Employee ID</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo $order['emp_id']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="order-container">
        <h2>Add New Order</h2>
        <form id="order-form" class="order-form" method="POST">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" placeholder="Enter Customer name" required>
            
            <label for="emp_id">Service Provider:</label>
            <select id="emp_id" name="emp_id" required>
                <option value="">Select Employee</option>
                <option value="1">Sivan</option>
                <option value="2">Saugat</option>
                <option value="3">Dharma</option>
            </select>
            
            <button type="submit" class="submit-order-btn">Submit Order</button>
        </form>
    </div>
</main>
<a href="index.php" class="back-to-home">Back to Home</a>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Aman's Canteen. All rights reserved.</p>
</footer>
</body>
</html>
