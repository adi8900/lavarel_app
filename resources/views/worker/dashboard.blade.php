<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Użyj tych samych stylów co w Admin Dashboard */
    </style>
</head>
<body class="custom-bg-light font-size-normal">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Worker Dashboard</a>
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
                <h1>Worker Dashboard</h1>
                <p>Welcome, {{ auth()->user()->name }}!</p>

                <!-- Buttons for Worker Actions -->
                <a href="{{ route('worker.repairs') }}" class="btn btn-primary mb-2">View Repairs</a>
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
const card = document.querySelector('.card'); // Pobierz element karty
const darkModeBtn = document.getElementById('darkModeBtn');
const lightModeBtn = document.getElementById('lightModeBtn');
const contrastModeBtn = document.getElementById('contrastModeBtn');
const increaseFontBtn = document.getElementById('increaseFontBtn');
const decreaseFontBtn = document.getElementById('decreaseFontBtn');

let fontSizeClass = 'font-size-normal'; // Domyślna klasa rozmiaru czcionki

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

// Funkcja do zmiany motywu
function setTheme(themeClass) {
    // Aktualizuj body
    body.classList.remove('custom-bg-dark', 'custom-bg-light', 'high-contrast');
    body.classList.add(themeClass);

    // Aktualizuj kartę
    card.classList.remove('custom-bg-dark', 'custom-bg-light', 'high-contrast');
    card.classList.add(themeClass);
}

// Aktualizuj rozmiar czcionki
function updateFontSize() {
    body.classList.remove('font-size-normal', 'font-size-large', 'font-size-xlarge');
    body.classList.add(fontSizeClass);
}
    </script>
</body>
</html>