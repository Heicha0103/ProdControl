// User Profile Dropdown
document.addEventListener('DOMContentLoaded', function() {
    // Add click handler for user profile dropdown
    document.addEventListener('click', function(e) {
        const userProfile = document.querySelector('.user-profile');
        if (!userProfile) return;

        if (userProfile.contains(e.target)) {
            userProfile.classList.toggle('open');
        } else {
            userProfile.classList.remove('open');
        }
    });

    // Handle help menu item click
    document.querySelector('.user-dropdown .dropdown-item:first-child')?.addEventListener('click', function(e) {
        e.preventDefault();
        // Add your help functionality here
        console.log('Help clicked');
    });

    // Handle logout menu item click
    document.querySelector('.user-dropdown a[href="login.html"]')?.addEventListener('click', function(e) {
        e.preventDefault();
        // Add your logout functionality here, for now just redirect
        window.location.href = 'login.html';
    });
});

// Notifications
const notifications = document.querySelector('.notifications');
if (notifications) {
    notifications.addEventListener('click', function() {
        // Implementation for notifications panel
        console.log('Notifications clicked');
    });
}

// Search Functionality
const searchInput = document.querySelector('.search-bar input');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        // Implementation for search functionality
        console.log('Searching for:', e.target.value);
    });
}

// Responsive Sidebar
function handleResponsiveSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (window.innerWidth <= 1024) {
        sidebar.classList.add('collapsed');
        mainContent.style.marginLeft = '80px';
    } else {
        sidebar.classList.remove('collapsed');
        mainContent.style.marginLeft = '250px';
    }
}

window.addEventListener('resize', handleResponsiveSidebar);
handleResponsiveSidebar();

// Sample data for charts (to be replaced with real data)
const productionData = {
    labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
    values: [65, 72, 68, 74, 80, 75, 70]
};

const inventoryData = {
    labels: ['Materias Primas', 'En Proceso', 'Terminados'],
    values: [30, 45, 25]
};

// Function to update stats and charts (to be implemented with real data)
function updateDashboardData() {
    // Update stats
    document.querySelectorAll('.stat-number').forEach(stat => {
        // Simulate real-time updates
        const currentValue = parseFloat(stat.textContent);
        const newValue = currentValue + (Math.random() * 2 - 1);
        stat.textContent = newValue.toFixed(0) + '%';
    });

    // Update charts (placeholder)
    document.querySelectorAll('.chart-placeholder').forEach(placeholder => {
        placeholder.textContent = 'Gráfico aquí (implementar con biblioteca de gráficos)';
    });
}

// Update dashboard data periodically
setInterval(updateDashboardData, 5000);

// Activity List Updates
function addNewActivity(activity) {
    const activityList = document.querySelector('.activity-list');
    if (!activityList) return;

    const activityItem = document.createElement('div');
    activityItem.className = 'activity-item';
    activityItem.innerHTML = `
        <div class="activity-icon">${activity.icon}</div>
        <div class="activity-details">
            <h4>${activity.title}</h4>
            <p>${activity.description}</p>
            <span class="activity-time">Ahora mismo</span>
        </div>
    `;

    activityList.insertBefore(activityItem, activityList.firstChild);
    
    // Remove oldest activity if more than 5
    if (activityList.children.length > 5) {
        activityList.removeChild(activityList.lastChild);
    }
}

// Simulate new activities periodically
setInterval(() => {
    const activities = [
        {
            icon: '📋',
            title: 'Nueva orden de producción',
            description: 'Orden #' + Math.floor(Math.random() * 10000) + ' iniciada'
        },
        {
            icon: '✓',
            title: 'Control de calidad completado',
            description: 'Lote #' + Math.floor(Math.random() * 1000) + ' aprobado'
        },
        {
            icon: '⚠️',
            title: 'Alerta de inventario',
            description: 'Nivel bajo en almacén'
        }
    ];

    const randomActivity = activities[Math.floor(Math.random() * activities.length)];
    addNewActivity(randomActivity);
}, 15000);