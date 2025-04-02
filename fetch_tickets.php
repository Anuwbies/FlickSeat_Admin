<?php
header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "flickseat_db");
if ($conn->connect_error) {
    die(json_encode(['error' => 'DB Connection Failed']));
}

// First get the latest ticket ID we've notified about
$lastNotifiedId = 0;
$result = $conn->query("SELECT value FROM system_settings WHERE setting_name = 'last_notified_ticket_id'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastNotifiedId = (int)$row['value'];
}

// Get all tickets newer than the last notified one
$sql = "SELECT * FROM tickets WHERE ticket_id > $lastNotifiedId ORDER BY purchase_date DESC";
$result = $conn->query($sql);

$tickets = [];
$newTickets = [];
while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
    $newTickets[] = $row;
}

// If there are new tickets, create notifications and update the last notified ID
if (!empty($newTickets)) {
    $maxId = $lastNotifiedId;
    foreach ($newTickets as $ticket) {
        if ($ticket['ticket_id'] > $maxId) {
            $maxId = $ticket['ticket_id'];
        }
        
        // Create notification for each new ticket
        $message = "New reservation #{$ticket['ticket_id']} for movie ID {$ticket['movie_id']}";
        $conn->query("INSERT INTO notifications (title, message) VALUES ('New Reservation', '$message')");
    }
    
    // Update the last notified ID
    $conn->query("REPLACE INTO system_settings (setting_name, value) VALUES ('last_notified_ticket_id', $maxId)");
}

// Now get all tickets for the response (not just new ones)
$result = $conn->query("SELECT * FROM tickets ORDER BY purchase_date DESC");
$tickets = [];
while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
}

echo json_encode($tickets);
$conn->close();