<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        header {
            background-color: #f11e1eb2;
            color: rgba(78, 99, 221, 0.767);
            padding: 20px;
            width: 100%;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            font-size: 45px;
            position: fixed;
            top: 0;
            z-index: 999;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            width: 100%;
            text-align: center;
            position: fixed;
            bottom: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            text-align: left;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: #ff0000;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<header>
    Aman's Canteen
</header>

<form action="login.php" method="post">
    <h2>Login</h2>

    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <label for="uname">Username</label>
    <input type="text" id="uname" name="uname" placeholder="Enter your username">

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter your password">

    <button type="submit">Login</button>
</form>

<footer>
    &copy; <?php echo date("Y"); ?> Aman's Canteen. All rights reserved.
</footer>

</body>
</html>
