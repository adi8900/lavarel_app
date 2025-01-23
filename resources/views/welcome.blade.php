<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body.custom-bg-dark {
            background-color: #2c2c2c;
            color: #f8f9fa; /* White text on dark background */
        }

        body.custom-bg-light {
            background-color: #f8f9fa;
            color: #212529; /* Dark text on light background */
        }

        body.high-contrast {
            background-color: #000000;
            color: #ffff00; /* Yellow text on black background */
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

        /* Global font sizes */
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm custom-bg-light">
                    <div class="card-body text-center">
                        <h1 class="mb-4">Witaj w aplikacji serwisu telefonów!</h1>

                        <!-- User Authentication -->
                        @auth
                            <p class="lead">Jesteś zalogowany jako {{ auth()->user()->name }}.</p>

<!-- Role-Specific Links -->
@if(auth()->user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-2">Panel Administratora</a>
    <a href="{{ route('repairs.index') }}" class="btn btn-warning mb-2">Naprawy</a>
@elseif(auth()->user()->role === 'worker')
    <a href="{{ route('worker.repairs') }}" class="btn btn-warning mb-2">Panel Pracownika</a>
@else
    <a href="{{ route('user.repairs') }}" class="btn btn-info mb-2">Twoje Naprawy</a>
    <a href="{{ route('reviews.index') }}" class="btn btn-secondary mb-2">Zobacz Recenzje</a>
@endif

                            <!-- Logout Button -->
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">Wyloguj się</button>
                            </form>
                        @else
                            <p class="lead">Nie jesteś zalogowany.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Zaloguj się</a>
                            lub
                            <a href="{{ route('register') }}" class="btn btn-success">Zarejestruj się</a>
                        @endauth

                        <!-- Accessibility Options -->
                        <hr class="my-4">
                        <h5>Dostosowanie wyglądu</h5>
                        <div class="d-flex justify-content-center gap-2">
                            <button id="darkModeBtn" class="btn btn-secondary">Ciemne tło</button>
                            <button id="lightModeBtn" class="btn btn-light">Jasne tło</button>
                            <button id="contrastModeBtn" class="btn btn-warning">Wysoki kontrast</button>
                            <button id="increaseFontBtn" class="btn btn-info">Większa czcionka</button>
                            <button id="decreaseFontBtn" class="btn btn-info">Mniejsza czcionka</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
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
