<?php
header('Content-Type: application/json');

include 'wala.php'; // Include your database connection

// Get POST data
$type = $_POST['type'] ?? '';
$name = $_POST['name'] ?? '';
$price = $_POST['price'] ?? '';

if (empty($type) || empty($name) || empty($price)) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

try {
    // Determine which table to insert into
    $table = '';
    $nameField = '';
    $priceField = '';
    
    switch ($type) {
        case 'food':
            $table = 'foods';
            $nameField = 'food_name';
            $priceField = 'food_price';
            break;
        case 'drinks':
            $table = 'drinks';
            $nameField = 'drink_name';
            $priceField = 'drink_price';
            break;
        default:
            throw new Exception("Invalid type specified");
    }

    // Prepare and execute the insert statement
    $stmt = $conn->prepare("INSERT INTO $table ($nameField, $priceField) VALUES (?, ?)");
    $stmt->bind_param("sd", $name, $price);
    
    if ($stmt->execute()) {
        $new_id = $conn->insert_id;
        
        echo json_encode([
            'success' => true,
            'data' => [
                'id' => $new_id,
                'name' => $name,
                'price' => $price
            ]
        ]);
    } else {
        throw new Exception("Insert failed: " . $stmt->error);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

$conn->close();
?>