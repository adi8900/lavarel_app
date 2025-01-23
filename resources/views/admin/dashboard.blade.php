<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body.custom-bg-dark {
        background-color: #2c2c2c;
        color: #f8f9fa;
    }

    body.custom-bg-light {
        background-color: #f8f9fa;
        color: #212529;
    }

    body.high-contrast {
        background-color: #000000;
        color: #ffff00;
    }

    .card.custom-bg-dark {
        background-color: #3c3c3c;
        color: #f8f9fa;
    }

    .card.custom-bg-light {
        background-color: #ffffff;
        color: #212529;
    }

    .card.high-contrast {
        background-color: #000000;
        color: #ffff00;
    }

    /* Base Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Dark mode table styling */
    table.custom-bg-dark, table.custom-bg-dark th, table.custom-bg-dark td, table.custom-bg-dark tr {
        background-color: #333333 !important; /* Dark background for the table */
        color: #f8f9fa !important; /* Light text for visibility */
    }

    /* Light mode table styling */
    table.custom-bg-light, table.custom-bg-light th, table.custom-bg-light td, table.custom-bg-light tr {
        background-color: #ffffff !important; /* Light background for the table */
        color: #212529 !important; /* Dark text for visibility */
    }

    /* High contrast mode table styling */
    table.high-contrast, table.high-contrast th, table.high-contrast td, table.high-contrast tr {
        background-color: #000000 !important; /* Black background for high contrast */
        color: #ffff00 !important; /* Yellow text for high contrast */
    }

    /* Table header style */
    table th {
        font-weight: bold;
    }

    /* For high contrast, make sure headers are clearly visible */
    table.high-contrast th {
        background-color: #ffff00 !important; /* Yellow header for high contrast */
        color: #000000 !important; /* Black text for visibility */
    }

    /* Adjust font size */
    body.font-size-normal, body.font-size-normal * {
        font-size: 18px !important;
    }

    body.font-size-large, body.font-size-large * {
        font-size: 20px !important;
    }

    body.font-size-xlarge, body.font-size-xlarge * {
        font-size: 22px !important;
    }
</style>


</head>
<body class="custom-bg-light font-size-normal">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="card shadow-sm custom-bg-light">
            <div class="card-body text-center">
                <h1>Admin Dashboard</h1>
                <p>Welcome, {{ auth()->user()->name }}!</p>

                <!-- Buttons for Admin Actions -->
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-2">Admin Panel</a>
                <a href="{{ route('repairs.index') }}" class="btn btn-warning mb-2">Manage Repairs</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-warning mb-2">Manage Users</a>
                <a href="{{ route('reviews.index') }}" class="btn btn-warning mb-2">Manage Reviews</a>
                <!-- Accessibility Options -->
                <hr class="my-4">
                <h5>Accessibility Options</h5>
                <div class="d-flex justify-content-center gap-2">
                    <button id="darkModeBtn" class="btn btn-secondary">Dark Mode</button>
                    <button id="lightModeBtn" class="btn btn-light">Light Mode</button>
                    <button id="contrastModeBtn" class="btn btn-warning">High Contrast</button>
                    <button id="increaseFontBtn" class="btn btn-info">Increase Font</button>
                    <button id="decreaseFontBtn" class="btn btn-info">Decrease Font</button>
                </div>
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <script>
const body = document.body;
const card = document.querySelector('.card');
const table = document.querySelector('table');  // Get the table element
const darkModeBtn = document.getElementById('darkModeBtn');
const lightModeBtn = document.getElementById('lightModeBtn');
const contrastModeBtn = document.getElementById('contrastModeBtn');
const increaseFontBtn = document.getElementById('increaseFontBtn');
const decreaseFontBtn = document.getElementById('decreaseFontBtn');

let fontSizeClass = 'font-size-normal'; // Default font size class

darkModeBtn.addEventListener('click', () => {
    setTheme('custom-bg-dark');
});

lightModeBtn.addEventListener('click', () => {
    setTheme('custom-bg-light');
});

contrastModeBtn.addEventListener('click', () => {
    setTheme('high-contrast');
});

increaseFontBtn.addEventListener('click', () => {
    if (fontSizeClass === 'font-size-normal') {
        fontSizeClass = 'font-size-large';
    } else if (fontSizeClass === 'font-size-large') {
        fontSizeClass = 'font-size-xlarge';
    }
    updateFontSize();
});

decreaseFontBtn.addEventListener('click', () => {
    if (fontSizeClass === 'font-size-xlarge') {
        fontSizeClass = 'font-size-large';
    } else if (fontSizeClass === 'font-size-large') {
        fontSizeClass = 'font-size-normal';
    }
    updateFontSize();
});

// Function to change the theme
function setTheme(themeClass) {
    // Update the body and other components like card, table
    body.classList.remove('custom-bg-dark', 'custom-bg-light', 'high-contrast');
    body.classList.add(themeClass);

    card.classList.remove('custom-bg-dark', 'custom-bg-light', 'high-contrast');
    card.classList.add(themeClass);

    table.classList.remove('custom-bg-dark', 'custom-bg-light', 'high-contrast');
    table.classList.add(themeClass);
}

// Update font size
function updateFontSize() {
    body.classList.remove('font-size-normal', 'font-size-large', 'font-size-xlarge');
    body.classList.add(fontSizeClass);
}
    </script>
</body>
</html>