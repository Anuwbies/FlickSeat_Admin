<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "flickseat_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch only recently approved (confirmed) tickets
$sql = "SELECT * FROM tickets WHERE status = 'confirmed' ORDER BY purchase_date DESC LIMIT 10";
$result = $conn->query($sql);

// Prepare the data array
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return as JSON
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>
