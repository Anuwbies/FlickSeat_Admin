<?php include 'wala.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Menu System</title>
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<!-- Delete Confirmation Modal -->
<div class="modal" id="delete-modal">
    <div class="modal-content">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete this item?</p>
        <div class="form-actions">
            <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>
            <button type="button" class="delete-confirm-btn" onclick="deleteItem()">Delete</button>
        </div>
    </div>
</div>

<div class="toast-container" id="toast-container"></div>

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
<div class="container">
    <header>
        <h1>Settings</h1>
        <div class="tabs">
            <button class="tab-button active" data-tab="food">Food Menu</button>
            <button class="tab-button" data-tab="drinks">Drinks Menu</button>
            <button class="tab-button" data-tab="movies">Movies</button>
        </div>
    </header>

    <div class="tab-content active" id="food-tab">
        <div class="table-header">
            <h2>Food Items</h2>
            <button class="add-btn" onclick="openModal('food')">
                <i class="fas fa-plus"></i> Add Food
            </button>
        </div>
        <div class="table-container">
            <table id="food-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Food Name</th>
                    <th>Price (₱)</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM foods";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr data-id='{$row['food_id']}'>
                                <td>{$row['food_id']}</td>
                                <td>{$row['food_name']}</td>
                                <td>₱{$row['food_price']}</td>
                                <td class='actions'>
                                    <button class='edit-btn' onclick='openEditModal(\"food\", {$row['food_id']})'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='delete-btn' onclick='confirmDelete(\"food\", {$row['food_id']})'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No food items found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-content" id="movies-tab">
        <div class="table-header">
            <h2>Movie Listings</h2>
            <button class="add-btn" onclick="openModal('movies')">
                <i class="fas fa-plus"></i> Add Movie
            </button>
        </div>
        <div class="table-container">
            <table id="movies-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Release Date</th>
                    <th>Duration</th>
                    <th>Rating</th>
                    <th>Price (₱)</th>
                    <th>Status</th>
                    <th>TMDB ID</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM movie";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr data-id='{$row['movie_id']}'>
                                <td>{$row['movie_id']}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['genre']}</td>
                                <td>{$row['release_date']}</td>
                                <td>{$row['duration']}</td>
                                <td>{$row['rating']}</td>
                                <td>₱{$row['movie_price']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['tmdb_id']}</td>
                                <td class='actions'>
                                    <button class='edit-btn' onclick='openEditModal(\"movies\", {$row['movie_id']})'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='delete-btn' onclick='confirmDelete(\"movies\", {$row['movie_id']})'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No movies found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-content" id="drinks-tab">
        <div class="table-header">
            <h2>Drink Items</h2>
            <button class="add-btn" onclick="openModal('drinks')">
                <i class="fas fa-plus"></i> Add Drink
            </button>
        </div>
        <div class="table-container">
            <table id="drinks-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Drink Name</th>
                    <th>Price (₱)</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM drinks";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr data-id='{$row['drink_id']}'>
                                <td>{$row['drink_id']}</td>
                                <td>{$row['drink_name']}</td>
                                <td>₱{$row['drink_price']}</td>
                                <td class='actions'>
                                    <button class='edit-btn' onclick='openEditModal(\"drinks\", {$row['drink_id']})'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                    <button class='delete-btn' onclick='confirmDelete(\"drinks\", {$row['drink_id']})'>
                                        <i class='fas fa-trash'></i>
                                    </button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No drink items found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Modal for Add/Edit -->
<div class="modal" id="item-modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2 id="modal-title">Add New Item</h2>
        <form id="item-form">
            <input type="hidden" id="item-type">
            <input type="hidden" id="item-id">
            
            <div class="form-group">
        <label for="item-name">Name</label>
        <input type="text" id="item-name" required>
    </div>
    
    <div class="form-group" id="price-group">
        <label for="item-price">Price (₱)</label>
        <input type="number" id="item-price" min="0" step="0.01" required>
    </div>

            <!-- Movie-specific fields -->
            <div class="form-group" id="genre-group" style="display: none;">
                <label for="item-genre">Genre</label>
                <input type="text" id="item-genre">
            </div>

            <div class="form-group" id="release-date-group" style="display: none;">
                <label for="item-release-date">Release Date</label>
                <input type="date" id="item-release-date">
            </div>

            <div class="form-group" id="duration-group" style="display: none;">
                <label for="item-duration">Duration (minutes)</label>
                <input type="text" id="item-duration" min="0">
            </div>

            <div class="form-group" id="rating-group" style="display: none;">
                <label for="item-rating">Rating (0-10)</label>
                <input type="number" id="item-rating" min="0" max="10" step="0.1">
            </div>

            <div class="form-group" id="status-group" style="display: none;">
                <label for="item-status">Status</label>
                <select id="item-status" name="status">
                    <option value="Coming Soon">Coming Soon</option>
                    <option value="Now Showing">Now Showing</option>
                </select>
            </div>

            <div class="form-group" id="overview-group" style="display: none;">
                <label for="item-overview">Overview</label>
                <textarea id="item-overview" rows="3"></textarea>
            </div>

            <div class="form-group" id="tmdb-id-group" style="display: none;">
                <label for="item-tmdb-id">TMDB ID</label>
                <input type="text" id="item-tmdb-id">
            </div>

            <div class="form-actions">
                <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                <button type="submit" class="save-btn">Save</button>
            </div>
        </form>
    </div>
</div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons and tabs
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            
            // Add active class to clicked button and corresponding tab
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Form submission
    const itemForm = document.getElementById('item-form');
    itemForm.addEventListener('submit', function(e) {
        e.preventDefault();
        saveItem();
    });
});

let currentDeleteType = '';
let currentDeleteId = '';

function openModal(type) {
    const modal = document.getElementById('item-modal');
    const modalTitle = document.getElementById('modal-title');
    const itemType = document.getElementById('item-type');
    
    // Reset form and hide all optional fields
    document.getElementById('item-form').reset();
    document.getElementById('item-id').value = '';
    document.getElementById('genre-group').style.display = 'none';
    document.getElementById('release-date-group').style.display = 'none';
    document.getElementById('duration-group').style.display = 'none';
    document.getElementById('rating-group').style.display = 'none';
    document.getElementById('price-group').style.display = 'none';
    document.getElementById('status-group').style.display = 'none';
    document.getElementById('overview-group').style.display = 'none';
    document.getElementById('tmdb-id-group').style.display = 'none'; // Ensure TMDB ID is hidden by default

    // Set modal title and fields based on type
    if (type === 'food') {
        modalTitle.textContent = 'Add New Food Item';
        document.getElementById('price-group').style.display = 'block';
        document.getElementById('item-name').placeholder = 'Food Name';
    } 
    else if (type === 'drinks') {
        modalTitle.textContent = 'Add New Drink Item';
        document.getElementById('price-group').style.display = 'block';
        document.getElementById('item-name').placeholder = 'Drink Name';
    }
    else if (type === 'movies') {
        modalTitle.textContent = 'Add New Movie';
        document.getElementById('item-name').placeholder = 'Movie Title';
        // Show all relevant fields for movies
        document.getElementById('genre-group').style.display = 'block';
        document.getElementById('release-date-group').style.display = 'block';
        document.getElementById('duration-group').style.display = 'block';
        document.getElementById('rating-group').style.display = 'block';
        document.getElementById('price-group').style.display = 'block';
        document.getElementById('status-group').style.display = 'block';
        document.getElementById('overview-group').style.display = 'block';
        document.getElementById('tmdb-id-group').style.display = 'block'; // Only show for movies
    }
    
    itemType.value = type;
    modal.style.display = 'block';
}

function openEditModal(type, id) {
    const modal = document.getElementById('item-modal');
    const modalTitle = document.getElementById('modal-title');
    const itemType = document.getElementById('item-type');
    const itemId = document.getElementById('item-id');
    
    // Hide all optional fields first
    document.getElementById('genre-group').style.display = 'none';
    document.getElementById('release-date-group').style.display = 'none';
    document.getElementById('duration-group').style.display = 'none';
    document.getElementById('rating-group').style.display = 'none';
    document.getElementById('price-group').style.display = 'none';
    document.getElementById('status-group').style.display = 'none';
    document.getElementById('overview-group').style.display = 'none';


    // Show loading state
    modalTitle.textContent = 'Loading...';
    modal.style.display = 'block';

    // Fetch item data with better error handling
    fetch(`get_item.php?type=${type}&id=${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success === false) {
                throw new Error(data.message || 'Unknown server error');
            }

            if (type === 'food') {
                modalTitle.textContent = 'Edit Food Item';
                document.getElementById('item-name').value = data.food_name;
                document.getElementById('item-price').value = data.food_price;
                document.getElementById('price-group').style.display = 'block';
            } 
            else if (type === 'drinks') {
                modalTitle.textContent = 'Edit Drink Item';
                document.getElementById('item-name').value = data.drink_name;
                document.getElementById('item-price').value = data.drink_price;
                document.getElementById('price-group').style.display = 'block';
            }
            else if (type === 'movies') {
                modalTitle.textContent = 'Edit Movie';
                document.getElementById('item-name').value = data.title;
                document.getElementById('item-genre').value = data.genre;
                document.getElementById('item-release-date').value = data.release_date;
                document.getElementById('item-duration').value = data.duration;
                document.getElementById('item-rating').value = data.rating;
                document.getElementById('item-price').value = data.movie_price;
                document.getElementById('item-status').value = data.status;
                document.getElementById('item-overview').value = data.overview;
                document.getElementById('item-tmdb-id').value = data.tmdb_id;
document.getElementById('tmdb-id-group').style.display = 'block';

                
                // Show all relevant fields for movies
                document.getElementById('genre-group').style.display = 'block';
                document.getElementById('release-date-group').style.display = 'block';
                document.getElementById('duration-group').style.display = 'block';
                document.getElementById('rating-group').style.display = 'block';
                document.getElementById('price-group').style.display = 'block';
                document.getElementById('status-group').style.display = 'block';
                document.getElementById('overview-group').style.display = 'block';
            }
            
            itemType.value = type;
            itemId.value = id;
        })
        .catch(error => {
            console.error('Fetch error:', error);
            modalTitle.textContent = 'Error';
            alert('Error fetching item data: ' + error.message);
            closeModal();
        });
}

function closeModal() {
    document.getElementById('item-modal').style.display = 'none';
}

function confirmDelete(type, id) {
    console.log('Confirm delete called with:', type, id);
    currentDeleteType = type;
    currentDeleteId = id;
    document.getElementById('delete-modal').style.display = 'block';
}

function closeDeleteModal() {
    document.getElementById('delete-modal').style.display = 'none';
}

function deleteItem() {
    console.log('Attempting to delete:', currentDeleteType, currentDeleteId);
    
    fetch(`delete_item.php?type=${currentDeleteType}&id=${currentDeleteId}`, {
        method: 'GET' // Changed from DELETE to GET since your PHP expects GET
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Delete response:', data);
        if (data.success) {
            const row = document.querySelector(`#${currentDeleteType}-table tr[data-id="${currentDeleteId}"]`);
            if (row) {
                row.remove();
                // Check if table is now empty
                if (document.querySelectorAll(`#${currentDeleteType}-table tbody tr`).length === 0) {
                    const cols = currentDeleteType === 'food' || currentDeleteType === 'drinks' ? 4 : 10;
                    document.querySelector(`#${currentDeleteType}-table tbody`).innerHTML = 
                        `<tr><td colspan="${cols}">No ${currentDeleteType} items found</td></tr>`;
                }
            }
            closeDeleteModal();
            alert('Item deleted successfully');
        } else {
            alert('Error deleting item: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        alert('Error deleting item: ' + error.message);
    });
}

async function saveItem() {
    const type = document.getElementById('item-type').value;
    const id = document.getElementById('item-id').value;
    const name = document.getElementById('item-name').value;
    const priceInput = document.getElementById('item-price');
    const saveBtn = document.querySelector('#item-form .save-btn');
    
    // Disable save button during processing
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    try {
        // Convert price to number and validate
        const price = parseFloat(priceInput.value);
        if (isNaN(price) || price <= 0) {
            throw new Error('Please enter a valid price greater than 0');
        }

        let endpoint = '';
        const data = new FormData();
        data.append('type', type);
        
        if (type === 'movies') {
            endpoint = id ? 'update_movie.php' : 'add_movie.php';
            if (id) data.append('movie_id', id);
            data.append('title', name);
            data.append('genre', document.getElementById('item-genre').value);
            data.append('release_date', document.getElementById('item-release-date').value);
            data.append('duration', document.getElementById('item-duration').value);
            data.append('rating', document.getElementById('item-rating').value);
            data.append('movie_price', price.toFixed(2));
            data.append('status', document.getElementById('item-status').value);
            data.append('overview', document.getElementById('item-overview').value);
            data.append('tmdb_id', document.getElementById('item-tmdb-id').value);
        } else {
            endpoint = id ? 'update_item.php' : 'add_item.php';
            if (id) data.append('id', id);
            data.append('name', name);
            data.append('price', price.toFixed(2));
        }

        const response = await fetch(endpoint, {
            method: 'POST',
            body: data
        });

        const result = await response.json();
        
        if (!result.success) {
            throw new Error(result.message || 'Failed to save item');
        }

        // Show success toast
        showToast(`${type.charAt(0).toUpperCase() + type.slice(1)} ${id ? 'updated' : 'added'} successfully!`);
        
        // Update the table without refresh
        updateTableRow(type, id, result.data || {
            id: id || result.insert_id,
            name,
            price
        });
        
        // Close the modal
        closeModal();
        
    } catch (error) {
        console.error('Error:', error);
        showToast(error.message, 'error', 5000);
    } finally {
        // Re-enable save button
        saveBtn.disabled = false;
        saveBtn.innerHTML = 'Save';
    }
}

function updateTableRow(type, id, data) {
    const tableId = `${type}-table`;
    const table = document.getElementById(tableId);
    
    if (!table) return;
    
    if (id) {
        // Update existing row
        const row = table.querySelector(`tr[data-id="${id}"]`);
        if (row) {
            if (type === 'movies') {
                row.innerHTML = `
                    <td>${data.id}</td>
                    <td>${data.title}</td>
                    <td>${data.genre}</td>
                    <td>${data.release_date}</td>
                    <td>${data.duration}</td>
                    <td>${data.rating}</td>
                    <td>₹${data.movie_price}</td>
                    <td>${data.status}</td>
                    <td>${data.tmdb_id}</td>
                    <td class="actions">
                        <button class="edit-btn" onclick="openEditModal('movies', ${data.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-btn" onclick="confirmDelete('movies', ${data.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            } else {
                const nameField = type === 'food' ? 'food_name' : 'drink_name';
                const priceField = type === 'food' ? 'food_price' : 'drink_price';
                row.innerHTML = `
                    <td>${data.id}</td>
                    <td>${data[nameField] || data.name}</td>
                    <td>₹${data[priceField] || data.price}</td>
                    <td class="actions">
                        <button class="edit-btn" onclick="openEditModal('${type}', ${data.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="delete-btn" onclick="confirmDelete('${type}', ${data.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            }
        }
    } else {
        // Add new row
        const tbody = table.querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-id', data.id);
        
        if (type === 'movies') {
            newRow.innerHTML = `
                <td>${data.id}</td>
                <td>${data.title}</td>
                <td>${data.genre}</td>
                <td>${data.release_date}</td>
                <td>${data.duration}</td>
                <td>${data.rating}</td>
                <td>₹${data.movie_price}</td>
                <td>${data.status}</td>
                <td>${data.tmdb_id}</td>
                <td class="actions">
                    <button class="edit-btn" onclick="openEditModal('movies', ${data.id})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="delete-btn" onclick="confirmDelete('movies', ${data.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
        } else {
            newRow.innerHTML = `
                <td>${data.id}</td>
                <td>${data.name}</td>
                <td>₹${data.price}</td>
                <td class="actions">
                    <button class="edit-btn" onclick="openEditModal('${type}', ${data.id})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="delete-btn" onclick="confirmDelete('${type}', ${data.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
        }
        
        // Remove "No items" row if it exists
        const noItemsRow = tbody.querySelector('tr td[colspan]');
        if (noItemsRow) noItemsRow.parentElement.remove();
        
        tbody.appendChild(newRow);
    }
}

// Add these utility functions to your JavaScript
function showToast(message, type = 'success', duration = 3000) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    
    toast.innerHTML = `
        <div>
            <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
            ${message}
        </div>
        <button class="toast-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    container.appendChild(toast);
    
    // Auto-remove after duration
    if (duration > 0) {
        setTimeout(() => {
            toast.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }
    
    return toast;
}

const sidebar = document.querySelector(".sidebar");
const sidebarToggler = document.querySelector(".sidebar-toggler");
const menuToggler = document.querySelector(".menu-toggler");
const mainContent = document.querySelector(".main-content");

const collapsedSidebarWidth = "85px";
const expandedSidebarWidth = "280px";

// ✅ Load sidebar state IMMEDIATELY before any DOM updates
const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
if (isCollapsed) {
    sidebar.classList.add('collapsed');
} else {
    sidebar.classList.remove('collapsed');
}

// Function to update main content position
const updateMainContentMargin = () => {
    if (sidebar.classList.contains("collapsed")) {
        mainContent.style.marginLeft = collapsedSidebarWidth;
    } else {
        mainContent.style.marginLeft = expandedSidebarWidth;
    }
};

// ✅ Ensure margin is updated immediately after setting sidebar state
updateMainContentMargin();

// Toggle sidebar and adjust main content
sidebarToggler.addEventListener("click", () => {
    const isCollapsed = sidebar.classList.toggle("collapsed");
    // Store sidebar state in localStorage
    localStorage.setItem('sidebarCollapsed', isCollapsed);
    updateMainContentMargin();
});

// Ensure main content is adjusted on window resize
window.addEventListener("resize", () => {
    if (window.innerWidth >= 1024) {
        sidebar.style.height = "calc(100vh - 32px)";
        updateMainContentMargin();
    } else {
        sidebar.classList.remove("collapsed");
        sidebar.style.height = "auto";
        toggleMenu(sidebar.classList.contains("menu-active"));
        updateMainContentMargin();
    }
});

// ✅ Keep sidebar state consistent across page reloads and navigation
window.addEventListener('load', () => {
    updateMainContentMargin(); // Ensure the content is positioned correctly after load
});

// Example usage:
// showToast('Item saved successfully!');
// showToast('Error saving item', 'error');
    </script>
</body>
</html>