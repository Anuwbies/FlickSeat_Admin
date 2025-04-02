<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "flickseat_db";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query all orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>
<?php $conn->close(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="styles.css">
    <title>Flickseat</title>
</head>
<body>
<aside class="sidebar">
        <header class="sidebar-header">
            <a href="#" class="header-logo">
                <img src="Logo.png" alt="logo">
            </a>
            <button class="toggler sidebar-toggler">
                <span class="material-symbols-rounded">chevron_left</span>
            </button>
            <button class="toggler menu-toggler">
                <span class="material-symbols-rounded">menu</span>
            </button>
        </header>
        <nav class="sidebar-nav">
            <ul class="nav-list primary-nav"> 
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <span class="material-symbols-rounded">dashboard</span>
                        <span class="nav-label">Dashboard</span>
                    </a>
                    <span class="nav-tooltip">Dashboard</span>
                </li>
                <li class="nav-item">
                    <a href="reservation.php" class="nav-link">
                        <span class="material-symbols-rounded">book</span>
                        <span class="nav-label">Reservations</span>
                    </a>
                    <span class="nav-tooltip">Reservations</span>
                </li>
                <li class="nav-item">
                    <a href="notifications.php" class="nav-link">
                        <span class="material-symbols-rounded">notifications</span>
                        <span class="nav-label">Notifications</span>
                    </a>
                    <span class="nav-tooltip">Notifications</span>
                </li>
                <li class="nav-item">
                    <a href="food.php" class="nav-link">
                        <span class="material-symbols-rounded">fastfood</span>
                        <span class="nav-label">Food & Drinks</span>
                    </a>
                    <span class="nav-tooltip">Pagkain</span>
                </li>
                <li class="nav-item">
                    <a href="users.php" class="nav-link">
                        <span class="material-symbols-rounded">groups</span>
                        <span class="nav-label">Users</span>
                    </a>
                    <span class="nav-tooltip">Accounts</span>
                </li>
            </ul>
            <ul class="nav-list secondary-nav">
            <li class="nav-item">
                    <a href="settings.php" class="nav-link">
                        <span class="material-symbols-rounded">settings</span>
                        <span class="nav-label">Settings</span>
                    </a>
                    <span class="nav-tooltip">Settings</span>
                </li>
                <li class="nav-item">
                    <a href="admin.php" class="nav-link">
                        <span class="material-symbols-rounded">account_circle</span>
                        <span class="nav-label">Admin</span>
                    </a>
                    <span class="nav-tooltip">Account</span>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <span class="material-symbols-rounded">logout</span>
                        <span class="nav-label">Logout</span>
                    </a>
                    <span class="nav-tooltip">Logout</span>
                </li>
            </ul>
        </nav>
    </aside>

    <div class="main-content">

    <div class="orders-container">
    <h1>Food and Drink Orders</h1>

    <table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Food</th>
            <th>Drink</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row["order_id"] ?></td>
                    <td><?= $row["user_id"] ?></td>
                    <td>
                        <?= is_null($row["food_id"]) ? "the customer didn't buy food" : $row["food_id"] ?>
                    </td>
                    <td>
                        <?= is_null($row["drink_id"]) ? "the customer didn't buy drinks" : $row["drink_id"] ?>
                    </td>
                    <td><?= $row["quantity"] ?></td>
                    <td><?= $row["status"] ?></td>
                    <td>
                        <button class="delete-btn" onclick="deleteOrder(<?= $row['order_id'] ?>)">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7">No orders found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
    </div>

    
    <script src="script.js"></script>
</body>
</html>