<?php
// delete_order.php
header('Content-Type: application/json');

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "flickseat_db";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => "Connection failed: " . $conn->connect_error]));
}

$order_id = $_POST['order_id'] ?? null;

if (!$order_id) {
    echo json_encode(['success' => false, 'error' => 'No order ID provided']);
    exit;
}

// Delete the order
$sql = "DELETE FROM orders WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Order deleted successfully']);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$stmt->close();
$conn->close();
?>