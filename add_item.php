<?php
include 'wala.php';
header('Content-Type: application/json');

try {
    // Validate input
    if (!isset($_POST['type']) || !isset($_POST['name']) || !isset($_POST['price'])) {
        throw new Exception("Missing required fields");
    }

    $type = $_POST['type'];
    $name = trim($_POST['name']);
    $price = (float)$_POST['price'];

    // Validate data
    if (empty($name) || $price <= 0) {
        throw new Exception("Invalid name or price");
    }

    // Determine table and fields based on type
    if ($type === 'food') {
        $table = 'foods';
        $nameField = 'food_name';
        $priceField = 'food_price';
    } elseif ($type === 'drinks') {
        $table = 'drinks';
        $nameField = 'drink_name';
        $priceField = 'drink_price';
    } else {
        throw new Exception("Invalid item type");
    }

    // Prepare and execute insert
    $stmt = $conn->prepare("INSERT INTO $table ($nameField, $priceField) VALUES (?, ?)");
    $stmt->bind_param("sd", $name, $price);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        throw new Exception($conn->error);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => true,
        'insert_id' => $conn->insert_id,
        'data' => [
            'id' => $conn->insert_id,
            'name' => $name,
            'price' => $price
        ]
    ]);
}

$conn->close();
?>