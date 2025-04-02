<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Modern Notifications</title>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:wght@400;500;600;700&display=swap');
        :root {
            --primary-color: #6a0dad;
            --primary-dark: #4b0082;
            --primary-light: #9b59b6;
            --dark-color: #1a1a1a;
            --light-color: #ffffff;
            --gray-color: #f0f0f0;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        *{
    font-family: "Poppins", "Montserrat",serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    background: rgb(0, 0, 0);
    min-height: 100vh;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    overflow-x: hidden;
}

.sidebar{
    width: 290px;
    height: calc(100vh - 32px);
    background: #1c223b;
    margin: 12px;
    border-radius: 16px;
    position: fixed;
    transition: 0.4s ease;          
}
.sidebar.collapsed{
    width: 85px;
}
.sidebar-header{
    position: relative;
    display: flex;
    padding: 25px 20px;
    align-items: center;
    justify-content: space-between; 
}
.sidebar-header .header-logo img{
    width: 50px;
    height: 50px;
    object-fit: contain;
    border-radius: 50%;
    display: block;
}
.sidebar-nav .nav-link{
    color: #fff;
    text-decoration: none;
    padding: 12px 15px;
    align-items: center;
    display: flex;
    border-radius: 8px;
    gap: 10px; 
    transition: 0.4s ease;
    white-space: nowrap;
}
.sidebar-nav .nav-link:hover{
    background: #fff;
    color: #151a2d;
}
.sidebar-nav .nav-list{
    list-style: none;
    display: flex;
    gap: 4px;
    padding: 0 15px;
    flex-direction: column;
    transform: translateY(15px);
    transition: 0.4s ease;
}
.sidebar-header .toggler{
    width: 35px;
    height: 35px;
    color: #151a2d;
    border: none;
    border-radius: 8px;
    background: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.4s ease;
}
.sidebar-header .sidebar-toggler{
    position: absolute;
    right: 20px;
}
.sidebar-header .menu-toggler{
    display: none;
}
.sidebar.collapsed .sidebar-header .sidebar-toggler{
    transform: translate(-4px, 65px);
}
.sidebar.collapsed .sidebar-nav .primary-nav{
    transform: translateY(65px);
}
.sidebar-header .sidebar-toggler span{
    font-size: 1.75rem;
    transition: 0.4s ease;
}
.sidebar-header .toggler:hover{
    background: #dde4fb;
}
.sidebar.collapsed .sidebar-header .sidebar-toggler span{
    transform: rotate(180deg);
}
.sidebar-nav .secondary-nav{
    position: absolute;
    bottom: 30px;
    width: 100%;
}
.sidebar-nav .nav-link .nav-label{
    transition: opacity 0.4s ease;
}
.sidebar.collapsed .sidebar-nav .nav-link .nav-label{
    opacity: 0;
    pointer-events: none;
}
.sidebar-nav .nav-tooltip{
    opacity: 0;
    pointer-events: none;
    color: #151a2d;
    padding: 6px 12px;
    background: #fff;
    border-radius: 8px;
    position: absolute;
    left: calc(100% + 25px);
    top: -10px;
    box-shadow: 0 5px 10px rgba(0, 0, 0 ,0.1);
    white-space: nowrap;
    transition: 0s ease;
    display: none;
}
.sidebar-nav .nav-item{
    position: relative;
}
.sidebar-nav .nav-item:hover .nav-tooltip{
    opacity: 1;
    pointer-events: auto;
    transform: translateY(50%);
    transition: 0.4s ease;
}
.sidebar.collapsed .sidebar-nav .nav-tooltip{
    display: block;
}

@media (max-width: 1024px){
    .sidebar {
        margin: 13px;
        width: calc(100% - 26px);
        height: 56px;
        overflow-y: hidden;
        max-height: calc(100vh - 26px);
        scrollbar-width: none;
    }
    .sidebar.menu-active{
        overflow-y: auto;
    }
    .sidebar-header{
        position: sticky;
        top: 0;
        z-index: 20;
        background: #151a2d;
        padding: 8px 10px;
        border-radius: 16px;
    }

    .sidebar-header .header-logo img{
        width: 40px;
        height: 40px;
    }

    .sidebar-nav .nav-list{
        padding: 0 10px;
    }

    .sidebar-nav .nav-link{
        gap: 10px;
        padding: 10px;
        font-size: 0.94rem;
    }

    .sidebar-nav .nav-link .nav-icon{
        font-size: 1.37rem;
    }
    .sidebar-header .menu-toggler{
        display: flex;
        height: 30px;
        width: 30px;
    }
    .sidebar-header .menu-toggler span{
        font-size: 1.3rem;
    }
    .sidebar-header .sidebar-toggler{
        display: none;
    }
    .sidebar-nav .secondary-nav{
        position: relative;
        bottom: 0;
        margin: 40px 0 30px;
    }
}
        
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .header h1 {
            color: var(--primary-dark);
            font-weight: 600;
        }
        
        .notification-badge {
            position: relative;
            cursor: pointer;
        }
        
        .badge-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .notification-icon {
            font-size: 24px;
            color: var(--primary-dark);
        }
        
        .notification-panel {
            background-color: var(--light-color);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: var(--primary-dark);
            color: white;
        }
        
        .panel-header h3 {
            font-weight: 500;
        }
        
        .mark-all-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 14px;
            text-decoration: underline;
            transition: var(--transition);
        }
        
        .mark-all-btn:hover {
            color: var(--gray-color);
        }
        
        .notification-list {
            max-height: 500px;
            overflow-y: auto;
        }
        
        .notification-item {
            padding: 15px 20px;
            border-bottom: 1px solid var(--gray-color);
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            transition: var(--transition);
        }
        
        .notification-item.unread {
    background-color: rgba(106, 13, 173, 0.05);
    border-left: 3px solid var(--primary-color);
    font-weight: 500;
}

.notification-item.unread .notification-title {
    color: var(--primary-dark);
    font-weight: 600;
}
        
        .notification-item:hover {
            background-color: rgba(106, 13, 173, 0.1);
        }
        .error-state {
    color: #e74c3c;
}

.error-state i {
    color: #e74c3c;
}

.error-state small {
    display: block;
    margin-top: 10px;
    font-size: 12px;
    color: #666;
}
        .notification-content {
            flex: 1;
        }
        
        .notification-title {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 5px;
        }
        
        .notification-message {
            color: var(--dark-color);
            font-size: 14px;
        }
        
        .notification-time {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        .notification-actions {
            display: flex;
            gap: 10px;
            margin-left: 15px;
        }
        
        .action-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #666;
            font-size: 14px;
            transition: var(--transition);
        }
        
        .action-btn:hover {
            color: var(--primary-color);
        }
        
        .delete-btn:hover {
            color: #e74c3c;
        }
        
        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #666;
        }
        
        .empty-state i {
            font-size: 48px;
            color: var(--primary-light);
            margin-bottom: 15px;
        }
        
        .empty-state p {
            font-size: 16px;
        }
        .panel-actions {
    display: flex;
    gap: 15px;
}

.delete-all-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: white;
    font-size: 14px;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 5px;
}

.delete-all-btn:hover {
    color: #ff6b6b;
}

/* Confirmation modal styles */
.confirmation-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    padding: 25px;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    max-width: 400px;
    width: 90%;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}
.main-content {
    padding: 20px;
    text-align: left;

    margin-left: 250px; /* Adjust based on sidebar width */
    transition: 0.4s ease;
    overflow-x: hidden;
}
.modal-btn {
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    transition: var(--transition);
    border: none;
}

.modal-btn-confirm {
    background-color: #e74c3c;
    color: white;
}

.modal-btn-cancel {
    background-color: var(--gray-color);
    color: var(--dark-color);
}

.modal-btn:hover {
    opacity: 0.9;
}
        @media (max-width: 768px) {
            .notification-item {
                flex-direction: column;
            }
            
            .notification-actions {
                margin-left: 0;
                margin-top: 10px;
                justify-content: flex-end;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <div class="container">
        <div class="header">
            <h1>Notifications</h1>
            <div class="notification-badge" id="notificationBadge">
                <i class="fas fa-bell notification-icon"></i>
                <span class="badge-count" id="badgeCount">0</span>
            </div>
        </div>
        
        <div class="notification-panel">
            <div class="panel-header">
                <h3>Your Notifications</h3>
                <div class="panel-actions">
        <button class="mark-all-btn" id="markAllRead">
            <i class="fas fa-check-double"></i> Mark all as read
        </button>
        <button class="delete-all-btn" id="deleteAll">
            <i class="fas fa-trash-alt"></i> Delete all
        </button>
    </div>
            </div>
            
            <div class="notification-list" id="notificationList">
                <!-- Notifications will be loaded here -->
                <div class="empty-state">
                    <i class="fas fa-bell-slash"></i>
                    <p>No notifications to display</p>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>

const USER_ID = <?php echo json_encode($_SESSION['user_id'] ?? 1); ?>;
        document.addEventListener('DOMContentLoaded', function() {
            const notificationList = document.getElementById('notificationList');
            const badgeCount = document.getElementById('badgeCount');
            const markAllReadBtn = document.getElementById('markAllRead');
            
            // Load notifications
            function loadNotifications() {
    console.log("Loading notifications...");
    
    fetch('notification_handler.php?action=get_notifications')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log("Received data:", data);
            if (data.error) {
                console.error("Error:", data.error);
                return;
            }
            updateBadgeCount(data.unread_count);
            renderNotifications(data.notifications);
        })
        .catch(error => {
            console.error('Error loading notifications:', error);
            // Show error to user
            notificationList.innerHTML = `
                <div class="empty-state error-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>Error loading notifications</p>
                    <small>${error.message}</small>
                </div>
            `;
        });
}
            
function renderNotifications(notifications) {
    if (notifications.length === 0) {
        notificationList.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-bell-slash"></i>
                <p>No notifications to display</p>
            </div>
        `;
        return;
    }
    
    notificationList.innerHTML = '';
    
    notifications.forEach(notification => {
        const isUnread = !notification.is_read; // Explicit check
        
        const notificationItem = document.createElement('div');
        notificationItem.className = `notification-item ${isUnread ? 'unread' : ''}`;
        notificationItem.dataset.id = notification.id;
        
        notificationItem.innerHTML = `
            <div class="notification-content">
                <div class="notification-title">${notification.title}</div>
                <div class="notification-message">${notification.message}</div>
                <div class="notification-time">${formatTime(notification.created_at)}</div>
            </div>
            <div class="notification-actions">
                ${isUnread ? 
                    `<button class="action-btn read-btn" data-id="${notification.id}">
                        <i class="fas fa-check"></i> Mark as read
                    </button>` : ''}
                <button class="action-btn delete-btn" data-id="${notification.id}">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
        `;
        
        notificationList.appendChild(notificationItem);
    });
    
    // Add event listeners
    document.querySelectorAll('.read-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            markAsRead(this.dataset.id);
        });
    });
    
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteNotification(this.dataset.id);
        });
    });
}
            
            // Format time
            function formatTime(timestamp) {
                const date = new Date(timestamp);
                return date.toLocaleString();
            }
            
            // Update badge count
            window.updateBadgeCount = function(count) {
    badgeCount.textContent = count;
    badgeCount.style.display = count > 0 ? 'flex' : 'none';
}

            
function markAsRead(notificationId) {
    const formData = new FormData();
    formData.append('notification_id', notificationId);
    
    fetch('notification_handler.php?action=mark_as_read', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Find the notification item and update its UI
            const notificationItem = document.querySelector(`.notification-item .read-btn[data-id="${data.notification_id}"]`)?.closest('.notification-item');
            if (notificationItem) {
                notificationItem.classList.remove('unread');
                notificationItem.querySelector('.read-btn')?.remove();
                
                // Update the unread count
                const currentCount = parseInt(badgeCount.textContent || '0');
                updateBadgeCount(Math.max(0, currentCount - 1));
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
            
            // Delete notification
            function deleteNotification(notificationId) {
                if (!confirm('Are you sure you want to delete this notification?')) {
                    return;
                }
                
                const formData = new FormData();
                formData.append('notification_id', notificationId);
                
                fetch('notification_handler.php?action=delete', {
            method: 'POST',
            body: formData
        })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadNotifications();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
            
            // Mark all as read
            markAllReadBtn.addEventListener('click', function() {
    fetch('notification_handler.php?action=mark_all_read', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove all unread classes and read buttons
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
                item.querySelector('.read-btn')?.remove();
            });
            
            // Reset the badge count to 0
            updateBadgeCount(0);
        }
    })
    .catch(error => console.error('Error:', error));
});

        // Add this to your existing JavaScript code
document.getElementById('deleteAll').addEventListener('click', function() {
    showDeleteAllConfirmation();
});

function showDeleteAllConfirmation() {
    const modal = document.createElement('div');
    modal.className = 'confirmation-modal';
    modal.innerHTML = `
        <div class="modal-content">
            <h3>Delete All Notifications</h3>
            <p>Are you sure you want to delete all notifications? This action cannot be undone.</p>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel">Cancel</button>
                <button class="modal-btn modal-btn-confirm">Delete All</button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    modal.style.display = 'flex';
    
    modal.querySelector('.modal-btn-cancel').addEventListener('click', function() {
        document.body.removeChild(modal);
    });
    
    modal.querySelector('.modal-btn-confirm').addEventListener('click', function() {
        deleteAllNotifications();
        document.body.removeChild(modal);
    });
}

function deleteAllNotifications() {
    fetch('notification_handler.php?action=delete_all', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `user_id=${encodeURIComponent(USER_ID)}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log("Delete response:", data);
        if (data.success) {
            // Show success message
            const notificationList = document.getElementById('notificationList');
            notificationList.innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-check-circle" style="color: #2ecc71;"></i>
                    <p>${data.message || 'All notifications deleted successfully'}</p>
                    ${data.deleted_count ? `<small>${data.deleted_count} notifications removed</small>` : ''}
                </div>
            `;
            updateBadgeCount(0);
        } else {
            showErrorModal(data.error || 'Failed to delete notifications', data.db_error || '');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        showErrorModal('An error occurred while deleting notifications', error.message);
    });
}

function showErrorModal(title, detail) {
    const modal = document.createElement('div');
    modal.className = 'confirmation-modal';
    modal.innerHTML = `
        <div class="modal-content">
            <h3 style="color: #e74c3c;">${title}</h3>
            <p>${detail || 'Please try again later.'}</p>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel">OK</button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    modal.style.display = 'flex';
    
    modal.querySelector('.modal-btn-cancel').addEventListener('click', function() {
        document.body.removeChild(modal);
    });
}
console.log("Sending user_id:", USER_ID);

loadNotifications();
            setInterval(loadNotifications, 30000);
        }); // This closes the DOMContentLoaded event listener


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

    </script>
</body>
</html>