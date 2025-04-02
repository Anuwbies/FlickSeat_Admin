<?php
include 'wala.php';
header('Content-Type: application/json');

try {
    // Validate input
    if (!isset($_POST['type']) || !isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['price'])) {
        throw new Exception("Missing required fields");
    }

    $type = $_POST['type'];
    $id = (int)$_POST['id'];
    $name = trim($_POST['name']);
    $price = (float)$_POST['price'];

    // Validate data
    if (empty($name) || $price <= 0) {
        throw new Exception("Invalid name or price");
    }

    // Determine table and fields based on type
    if ($type === 'food') {
        $table = 'foods';
        $idField = 'food_id';
        $nameField = 'food_name';
        $priceField = 'food_price';
    } elseif ($type === 'drinks') {
        $table = 'drinks';
        $idField = 'drink_id';
        $nameField = 'drink_name';
        $priceField = 'drink_price';
    } else {
        throw new Exception("Invalid item type");
    }

    // Prepare and execute update
    $stmt = $conn->prepare("UPDATE $table SET $nameField = ?, $priceField = ? WHERE $idField = ?");
    $stmt->bind_param("sdi", $name, $price, $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$conn->close();
?>