<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
        p {
            text-align: justify;
            color: #666;
        }
        .info {
            margin-top: 20px;
        }
        .back-to-home{
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-to-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>About Us</h1>

    <h2>Canteen Management System</h2>
    <p>Welcome to the Canteen Management System developed by Aman Mahato (1CR21CS023).</p>

    <div class="info">
        <h2>About Aman Mahato</h2>
        <p>Aman Mahato is a student at CMRIT,India, pursuing Computer Science. With a passion for coding and problem-solving, Aman developed this Canteen Management System as a part of a project for the course. This system aims to streamline the operations of the canteen, making it easier to manage inventory, track orders, and serve customers efficiently.</p>
        <p>If you have any questions or feedback regarding the Canteen Management System, feel free to contact Aman Mahato at aman.2579mahato@gmail.com.</p>
    </div>
    <a href="index.php" class="back-to-home">Back to Home</a>

</body>
</html>
