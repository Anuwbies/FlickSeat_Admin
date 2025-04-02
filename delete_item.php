<?php
include 'wala.php';
header('Content-Type: application/json');

$type = $_GET['type'];
$id = $_GET['id'];

try {
    if ($type === 'food') {
        $stmt = $conn->prepare("DELETE FROM foods WHERE food_id = ?");
    } 
    else if ($type === 'drinks') {
        $stmt = $conn->prepare("DELETE FROM drinks WHERE drink_id = ?");
    }
    else if ($type === 'movies') {
        $stmt = $conn->prepare("DELETE FROM movie WHERE movie_id = ?");
    } else {
        throw new Exception("Invalid type specified");
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Check if any rows were actually deleted
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No record found with that ID']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?>