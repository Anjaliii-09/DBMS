<?php
include "db.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $quantity = $_POST['quantity'];
    $stock = $_POST['stock'];

    // Update the item in the database
    $sql_update = "UPDATE inventory SET quantity='$quantity', stock='$stock' WHERE item='$item'";
    if (mysqli_query($conn, $sql_update)) {
        // Redirect to inventory.php after successful update
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error updating item: " . mysqli_error($conn);
    }
}

// Check if an item parameter is provided in the URL
if (isset($_GET['item'])) {
    $item = $_GET['item'];

    // Fetch the item from the database
    $sql_select = "SELECT * FROM inventory WHERE item='$item'";
    $result_select = mysqli_query($conn, $sql_select);

    if (!$result_select) {
        echo "Error fetching item: " . mysqli_error($conn);
    } else {
        $row = mysqli_fetch_assoc($result_select);
        // Ensure the item exists
        if (!$row) {
            echo "Item not found.";
            exit();
        }
    }
} else {
    // Redirect to inventory.php if no item is provided
    header("Location: inventory.php");
    exit();
}

mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Inventory Item</h2>
        <form action="edit1.php" method="post">
            <input type="hidden" name="item" value="<?php echo $row['item']; ?>">
            <label for="item">Item:</label>
            <input type="text" id="item" name="item" value="<?php echo $row['item']; ?>" readonly>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>
            <label for="stock">In stock:</label>
            <input type="text" id="stock" name="stock" value="<?php echo $row['stock']; ?>" required>
            <input type="submit" value="Update Item">
        </form>
    </div>
</body>
</html>
