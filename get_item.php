<?php
include 'wala.php';
header('Content-Type: application/json');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Validate inputs
    $type = $_GET['type'] ?? '';
    $id = intval($_GET['id'] ?? 0);
    
    if (empty($type)) {
        throw new Exception("Type parameter is required");
    }
    
    if ($id <= 0) {
        throw new Exception("Invalid ID parameter");
    }

    // Determine table and fields
    $table = '';
    $idColumn = '';
    $fields = [];
    
    switch ($type) {
        case 'food':
            $table = 'foods';
            $idColumn = 'food_id';
            $fields = ['food_id', 'food_name', 'food_price'];
            break;
        case 'drinks':
            $table = 'drinks';
            $idColumn = 'drink_id';
            $fields = ['drink_id', 'drink_name', 'drink_price'];
            break;
        case 'movies':
            $table = 'movie';
            $idColumn = 'movie_id';
            $fields = [
                'movie_id', 'title', 'genre', 'release_date', 
                'duration', 'overview', 'rating', 'tmdb_id',
                'status', 'movie_price'
            ];
            break;
        default:
            throw new Exception("Invalid type specified");
    }

    // Prepare query
    $fieldList = implode(', ', $fields);
    $stmt = $conn->prepare("SELECT $fieldList FROM $table WHERE $idColumn = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Item not found']);
        exit;
    }

    $data = $result->fetch_assoc();
    
    // Normalize movie data
    if ($type === 'movies') {
        // Ensure all fields exist
        $defaultMovie = [
            'title' => '',
            'genre' => '',
            'release_date' => date('Y-m-d'),
            'duration' => '0',
            'rating' => 0,
            'movie_price' => 0,
            'status' => 'Coming Soon',
            'overview' => '',
            'tmdb_id' => '0'
        ];
        $data = array_merge($defaultMovie, $data);
        
        // Normalize status
        $status = strtolower($data['status']);
        if (strpos($status, 'show') !== false || strpos($status, 'now') !== false) {
            $data['status'] = 'Now Showing';
        } else {
            $data['status'] = 'Coming Soon';
        }
        
        // Convert duration to minutes if needed
        if (strpos($data['duration'], 'h') !== false) {
            // Convert "2h 35m" format to minutes
            preg_match('/(\d+)h\s*(\d+)m/', $data['duration'], $matches);
            $hours = isset($matches[1]) ? (int)$matches[1] : 0;
            $minutes = isset($matches[2]) ? (int)$matches[2] : 0;
            $data['duration'] = ($hours * 60) + $minutes;
        }
    }
    
    echo json_encode($data);
    
} catch (Exception $e) {
    error_log("Error in get_item.php: " . $e->getMessage());
    
    echo json_encode([
        'success' => true,
        'data' => [
            'id' => $id,
            'name' => $name,
            'price' => $price
        ]
    ]);
}

$conn->close();
?>