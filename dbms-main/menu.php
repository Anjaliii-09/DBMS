<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
    <header>
        <h1>Menu</h1>
    </header>
    <main>
        <?php
        // Check if database connection is successful
        include "db.php"; // Include the database connection file

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Function to sanitize input data
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Handle form submission for adding new menu items
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize input data
            $item_name = sanitize_input($_POST["item_name"]);
            $category = sanitize_input($_POST["category"]);
            $price = sanitize_input($_POST["price"]);
            $timing = sanitize_input($_POST["timing"]);

            // Insert new item into the menu table
            $sql_insert = "INSERT INTO menu (item_name, category, price, Timing) VALUES ('$item_name', '$category', $price, '$timing')";
            if (mysqli_query($conn, $sql_insert)) {
                echo '<div class="success-msg">New item added to the menu successfully!</div>';
            } else {
                echo '<div class="error-msg">Error adding item to the menu: ' . mysqli_error($conn) . '</div>';
            }
        }

        // Retrieve unique categories from the database
        $sql_categories = "SELECT DISTINCT category FROM menu";
        $result_categories = mysqli_query($conn, $sql_categories);

        // Check if there are any categories returned
        if ($result_categories && mysqli_num_rows($result_categories) > 0) {
            // Loop through each category
            while ($row_category = mysqli_fetch_assoc($result_categories)) {
                // Display category section
                echo '<section>';
                echo '<h2>' . $row_category['category'] . '</h2>';

                // Retrieve menu items for the current category
                $category = $row_category['category'];
                $sql_items = "SELECT * FROM menu WHERE category='$category'";
                $result_items = mysqli_query($conn, $sql_items);

                // Check if there are any items in the current category
                if ($result_items && mysqli_num_rows($result_items) > 0) {
                    // Loop through each menu item in the current category
                    while ($row_item = mysqli_fetch_assoc($result_items)) {
                        // Display menu item
                        echo '<div class="menu-item">';
                        echo '<h3>' . $row_item['item_name'] . '</h3>';
                        // Check if 'Timing' exists before displaying
                        if (isset($row_item['Timing'])) {
                            echo '<p>Timing: ' . $row_item['Timing'] . '</p>';
                        } else {
                            echo '<p>Timing: Not available</p>';
                        }
                        echo '<p>Price: $' . $row_item['price'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No items found in this category.</p>';
                }

                echo '</section>';
            }
        } else {
            echo '<p>No categories found.</p>';
        }

        // Close database connection
        mysqli_close($conn);
        ?>
        
        <!-- Form for adding new menu items -->
        <section class="add-item-section">
            <h2>Add New Item</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="item_name">Item Name:</label>
                <input type="text" id="item_name" name="item_name" required>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>

                <label for="price">Price ($):</label>
                <input type="number" id="price" name="price" min="0" step="0.01" required>

                <label for="timing">Timing:</label>
                <input type="text" id="timing" name="timing">

                <button type="submit">Add Item</button>
            </form>
        </section>
    </main>
    <a href="index.php" class="back-to-home">Back to Home</a>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Aman's Canteen. All rights reserved.</p>
    </footer>
</body>
</html>
