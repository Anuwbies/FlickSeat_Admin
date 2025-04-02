<?php
header('Content-Type: application/json');
require_once 'db_config.php';

class NotificationHandler {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getNotifications() {
        $result = $this->conn->query("
            SELECT *, 
            (is_read = FALSE) as is_unread,
            CASE 
                WHEN type = 'new_reservation' THEN '🎟️ New Booking'
                WHEN type = 'status_change' THEN '🔄 Status Update'
                WHEN type = 'cancellation' THEN '❌ Cancellation'
                ELSE 'ℹ️ Notification'
            END as display_title
            FROM notifications 
            ORDER BY created_at DESC
        ");
        
        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $row['is_read'] = (bool)$row['is_read'];
            $notifications[] = $row;
        }
        return $notifications;
    }
    
    public function getUnreadCount() {
        $result = $this->conn->query("SELECT COUNT(*) as count FROM notifications WHERE is_read = FALSE");
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    
    public function markAsRead($notificationId) {
        $stmt = $this->conn->prepare("UPDATE notifications SET is_read = TRUE WHERE id = ?");
        $stmt->bind_param("i", $notificationId);
        $success = $stmt->execute();
        
        // Return both success status and the notification ID that was marked as read
        return ['success' => $success, 'notification_id' => $notificationId];
    }
    
    public function deleteNotification($notificationId) {
        $stmt = $this->conn->prepare("DELETE FROM notifications WHERE id = ?");
        $stmt->bind_param("i", $notificationId);
        return $stmt->execute();
    }
    
    public function markAllAsRead() {
        $success = $this->conn->query("UPDATE notifications SET is_read = TRUE WHERE is_read = FALSE");
        return ['success' => (bool)$success];
    }
    
    public function deleteAllNotifications() {
        $result = $this->conn->query("DELETE FROM notifications");
        return ['success' => (bool)$result, 'deleted_count' => $this->conn->affected_rows];
    }
}

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$handler = new NotificationHandler($conn);
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'get_notifications':
        echo json_encode([
            'notifications' => $handler->getNotifications(),
            'unread_count' => $handler->getUnreadCount()
        ]);
        break;
        
    case 'mark_as_read':
        $notificationId = $_POST['notification_id'] ?? 0;
        echo json_encode(['success' => $handler->markAsRead($notificationId)]);
        break;
        
    case 'delete_all':
        $result = $handler->deleteAllNotifications();
        if ($result['success']) {
            echo json_encode([
                'success' => true,
                'message' => 'All notifications deleted successfully',
                'deleted_count' => $result['deleted_count']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'error' => 'Failed to delete notifications',
                'db_error' => $conn->error
            ]);
        }
        break;
        
    case 'delete':
        $notificationId = $_POST['notification_id'] ?? 0;
        echo json_encode(['success' => $handler->deleteNotification($notificationId)]);
        break;
        
    case 'mark_all_read':
        echo json_encode(['success' => $handler->markAllAsRead()]);
        break;
        
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

$conn->close();
?>