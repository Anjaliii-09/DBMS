<?php
$servername = "127.0.0.1";
$username = "root"; 
$password = ""; 
$dbname = "canteen"; 

// Create a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function executeSQL($sql) {
    global $conn;
    if ($conn->query($sql) === TRUE) {
        return "Query executed successfully";
    } else {
        return "Error executing query: " . $conn->error;
    }
}

// Function to retrieve data from the database
function getData($sql) {
    global $conn;
    $result = $conn->query($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    return $data;
}

// Close connection (optional)
// mysqli_close($conn);
?>