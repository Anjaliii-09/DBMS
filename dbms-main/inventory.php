<?php 
include "db.php";

// Check if the item was added and redirect if necessary
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = mysqli_real_escape_string($conn, $_POST['item']); // Sanitize input
    $quantity = $_POST['quantity'];
    $stock = $_POST['stock'];

    // Check if the item already exists in the database
    $sql_check = "SELECT * FROM inventory WHERE item = '$item'";
    $result_check = mysqli_query($conn, $sql_check);

    if(mysqli_num_rows($result_check) > 0) {
        // Item already exists, handle accordingly (e.g., show an error message)
        echo "Item '$item' already exists in the inventory.";
    } else {
        // Insert data into the database
        $sql_insert = "INSERT INTO inventory (item, quantity, stock) VALUES ('$item', '$quantity', '$stock')";
        
        if (mysqli_query($conn, $sql_insert)) {
            // Redirect to prevent form resubmission
            header("Location: {$_SERVER['REQUEST_URI']}");
            exit();
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }
}

// Fetch items from the database
$sql_select = "SELECT * FROM inventory";
$result_select = mysqli_query($conn, $sql_select);

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Inventory Management</title>
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
        h1, h2 {
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
            padding: 5px 10px;
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
        <h1>Canteen Inventory Management</h1>

        <h2>Inventory List</h2>
        <table>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>In stock</th>
                <th>Action</th>
            </tr>
            <?php 
            // Dynamically generate table rows based on retrieved data
            while ($row = mysqli_fetch_assoc($result_select)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['item']) . "</td>"; // Escape output to prevent XSS
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>
                        <a href='edit1.php?item=" . urlencode($row["item"]) . "' class='btn'>Edit</a>
                        <a href='delete1.php?item=" . urlencode($row["item"]) . "' class='btn'>Delete</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </table>

        <h2>Add New Item</h2>
        <form action="inventory.php" method="post">
            <label for="item">Item:</label>
            <input type="text" id="item" name="item" required><br><br>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required><br><br>
            <label for="stock">In stock:</label>
            <input type="text" id="stock" name="stock" required><br><br>
            <input type="submit" value="Add Item">
        </form>
    </div>
    <a href="index.php" class="back-to-home">Back to Home</a>
</body>
</html>
