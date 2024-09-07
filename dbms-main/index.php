<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canteen Management System</title>
    <link rel="stylesheet" href="style.css"> <!-- Update the CSS file name -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <style>
        /* Add any additional styles here */
        /* Ensure proper spacing, alignment, and responsiveness */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        
        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        
        nav ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #ffd700; /* Change to your preferred hover color */
        }
        
        .message-box {
            background-color: #ffd700;
            color: #333;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .message-box:hover {
            background-color: #ffc107; /* Change to your preferred hover color */
        }
        
        .hero {
            text-align: center;
            padding: 50px 20px;
        }
        
        .hero h2 {
            margin-bottom: 20px;
            font-size: 2.5rem;
            color: #333;
        }
        
        .hero p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 40px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #555;
        }
        
        .features {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            padding: 50px 20px;
        }
        
        .feature {
            flex: 1;
            max-width: 300px;
            padding: 0 20px;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .feature h3 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 15px;
        }
        
        .feature p {
            font-size: 1.1rem;
            color: #666;
        }
        
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Aman's Canteen</h1>
        <nav>
            <ul>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="order.php">Orders</a></li>
                <li><a href="customer.php">Customers</a></li>
                <li><a href="inventory.php">Inventory</a></li>
                <li><a href="team.php">Our Team</a></li>
                <li><a href="about.php">About Us</a></li>
            </ul>
        </nav>
        <div class="message-box" onclick="redirectToManagerMessages()">
            <i class="fas fa-envelope"></i> Manager Messages
        </div>
    </header>
    <section class="hero">
        <h2>Manage Your Canteen with Ease</h2>
        <p>Our canteen management system helps you streamline operations, track inventory, manage orders, and more.</p>
        <a href="about.php" class="btn">Learn More</a>
    </section>
    <section class="features">
        <div class="feature">
            <h3>Menu Management</h3>
            <p>Easily create, update, and manage your canteen's menu items.</p>
        </div>
        <div class="feature">
            <h3>Order Tracking</h3>
            <p>Keep track of customer orders and manage order fulfillment efficiently.</p>
        </div>
        <div class="feature">
            <h3>Inventory Control</h3>
            <p>Monitor inventory levels, track stock movements, and manage supplies.</p>
        </div>
    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Aman's Canteen. All rights reserved.</p>
    </footer>
    <script>
        function redirectToManagerMessages() {
            window.location.href = "manager_messages.php";
        }
    </script>
</body>
</html>
