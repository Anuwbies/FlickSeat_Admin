<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "flickseat_db");
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'DB connection failed']));
}

$ticket_id = $_POST['ticket_id'];
$status = $_POST['status'];

// Prepare the update statement once for all statuses
$stmt = $conn->prepare("UPDATE tickets SET status = ? WHERE ticket_id = ?");
$stmt->bind_param("si", $status, $ticket_id);

if ($stmt->execute()) {
    // Get ticket details
    $ticketResult = $conn->query("SELECT * FROM tickets WHERE ticket_id = $ticket_id");
    $ticket = $ticketResult->fetch_assoc();
    
    // Create notification
    $title = "Ticket Status Updated";
    $message = "Ticket #$ticket_id changed to " . strtoupper($status);
    $type = 'status_change';
    
    $notifStmt = $conn->prepare("INSERT INTO notifications (title, message, type, related_id) VALUES (?, ?, ?, ?)");
    $notifStmt->bind_param("sssi", $title, $message, $type, $ticket_id);
    $notifStmt->execute();

    echo json_encode(['success' => true, 'message' => "Marked as $status"]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to update status']);
}

$stmt->close();
$conn->close();
