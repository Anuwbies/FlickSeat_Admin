<?php
// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'flickseat_db';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch users with pagination and search
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$start = ($page - 1) * $perPage;

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$searchCondition = $search ? 
    "WHERE username LIKE '%$search%' OR email LIKE '%$search%'" : '';

    $sql = "SELECT SQL_CALC_FOUND_ROWS user_id, email, username, password 
    FROM users $searchCondition 
    LIMIT $start, $perPage";

$result = $conn->query($sql);

$total = $conn->query("SELECT FOUND_ROWS()")->fetch_row()[0];
$pages = ceil($total / $perPage);

$users = [];
while ($row = $result->fetch_assoc()) {
    // Shorten the password hash for display
    $row['password'] = substr($row['password'], 0, 20) . '...';
    $users[] = $row;
}

header('Content-Type: application/json');
echo json_encode([
    'users' => $users,
    'pagination' => [
        'total' => $total,
        'pages' => $pages,
        'current' => $page
    ]
]);

$conn->close();
?>