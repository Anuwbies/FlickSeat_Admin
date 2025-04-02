<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="users.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
        <header>
            <h1>User Management</h1>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search users...">
                <button id="searchBtn"><i class="fas fa-search"></i></button>
            </div>
        </header>

        <div class="table-container">
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password Hash</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    <!-- Users will be loaded here -->
                </tbody>
            </table>

            <div class="table-footer">
                <div class="pagination-info" id="paginationInfo"></div>
                <div class="pagination-controls">
                    <button id="prevPage" disabled><i class="fas fa-chevron-left"></i></button>
                    <div id="pageNumbers"></div>
                    <button id="nextPage" disabled><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('usersTableBody');
    const searchInput = document.getElementById('searchInput');
    const searchBtn = document.getElementById('searchBtn');
    const prevPageBtn = document.getElementById('prevPage');
    const nextPageBtn = document.getElementById('nextPage');
    const pageNumbers = document.getElementById('pageNumbers');
    const paginationInfo = document.getElementById('paginationInfo');

    let currentPage = 1;
    let totalPages = 1;
    let currentSearch = '';

    // Load users on page load
    loadUsers(currentPage);

    // Search functionality
    searchBtn.addEventListener('click', function() {
        currentSearch = searchInput.value;
        currentPage = 1;
        loadUsers(currentPage, currentSearch);
    });

    // Allow search on Enter key
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            currentSearch = searchInput.value;
            currentPage = 1;
            loadUsers(currentPage, currentSearch);
        }
    });

    // Pagination controls
    prevPageBtn.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadUsers(currentPage, currentSearch);
        }
    });

    nextPageBtn.addEventListener('click', function() {
        if (currentPage < totalPages) {
            currentPage++;
            loadUsers(currentPage, currentSearch);
        }
    });

    // Load users function
    function loadUsers(page, search = '') {
        fetch(`fetch_users.php?page=${page}&search=${encodeURIComponent(search)}`)
            .then(response => response.json())
            .then(data => {
                renderUsers(data.users);
                updatePagination(data.pagination);
            })
            .catch(error => console.error('Error:', error));
    }

    // Render users to table
    function renderUsers(users) {
        tableBody.innerHTML = '';
        
        if (users.length === 0) {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan="5" class="no-results">No users found</td>`;
            tableBody.appendChild(row);
            return;
        }

        users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
    <td>${user.user_id}</td>
    <td>${user.email}</td>
    <td>${user.username}</td>
    <td>${user.password}</td>
    <td>
        <button class="action-btn delete" data-id="${user.user_id}">
            <i class="fas fa-trash-alt"></i> Delete
        </button>
    </td>
`;

            tableBody.appendChild(row);
        });

        // Add event listeners to delete buttons
        document.querySelectorAll('.action-btn.delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this user?')) {
                    deleteUser(userId);
                }
            });
        });
    }

    // Delete user function
    function deleteUser(userId) {
        const formData = new FormData();
        formData.append('delete_id', userId);

        fetch('fetch_users.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Reload current page after deletion
            loadUsers(currentPage, currentSearch);
        })
        .catch(error => console.error('Error:', error));
    }

    // Update pagination controls
    function updatePagination(pagination) {
        totalPages = pagination.pages;
        const total = pagination.total;
        const current = pagination.current;

        // Update pagination info
        const start = (current - 1) * 10 + 1;
        const end = Math.min(current * 10, total);
        paginationInfo.textContent = `Showing ${start} to ${end} of ${total} users`;

        // Update pagination buttons
        prevPageBtn.disabled = current === 1;
        nextPageBtn.disabled = current === totalPages || totalPages === 0;

        // Update page numbers
        pageNumbers.innerHTML = '';
        
        // Always show first page
        addPageNumber(1, current);
        
        // Show ellipsis if needed
        if (current > 3) {
            const ellipsis = document.createElement('span');
            ellipsis.textContent = '...';
            pageNumbers.appendChild(ellipsis);
        }
        
        // Show current page and neighbors
        for (let i = Math.max(2, current - 1); i <= Math.min(totalPages - 1, current + 1); i++) {
            addPageNumber(i, current);
        }
        
        // Show ellipsis if needed
        if (current < totalPages - 2) {
            const ellipsis = document.createElement('span');
            ellipsis.textContent = '...';
            pageNumbers.appendChild(ellipsis);
        }
        
        // Always show last page if there's more than one page
        if (totalPages > 1) {
            addPageNumber(totalPages, current);
        }
    }

    function addPageNumber(page, current) {
        const pageElement = document.createElement('span');
        pageElement.textContent = page;
        pageElement.className = 'page-number';
        if (page === current) {
            pageElement.classList.add('active');
        } else {
            pageElement.addEventListener('click', () => {
                currentPage = page;
                loadUsers(currentPage, currentSearch);
            });
        }
        pageNumbers.appendChild(pageElement);
    }
});

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