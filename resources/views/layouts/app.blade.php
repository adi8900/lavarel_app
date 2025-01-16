<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Naprawy')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-size: 16px; /* Domyślny rozmiar czcionki */
            background-color: #fff; /* Domyślne tło */
            color: #000; /* Domyślny kolor tekstu */
            transition: background-color 0.3s, color 0.3s; /* Płynna zmiana kolorów */
        }
        body.dark-mode {
            background-color: #2c2c2c; /* Ciemne tło */
            color: #f8f9fa; /* Jasny tekst */
        }
        body.high-contrast {
            background-color: #000; /* Czarne tło */
            color: #fff; /* Biały tekst */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Naprawy telefonów</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.repairs') }}">Moje Naprawy</a></li>
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Wyloguj
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Zaloguj</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Rejestracja</a></li>
                    @endauth
                </ul>
                <!-- Przyciski do zmiany wyglądu -->
                <div class="d-flex align-items-center ms-3">
                    <button id="darkModeBtn" class="btn btn-outline-dark btn-sm me-1">Ciemne tło</button>
                    <button id="lightModeBtn" class="btn btn-outline-secondary btn-sm me-1">Jasne tło</button>
                    <button id="highContrastBtn" class="btn btn-outline-warning btn-sm me-1">Wysoki kontrast</button>
                    <button id="returnContrastBtn" class="btn btn-outline-info btn-sm me-1" disabled>Powrót</button>
                    <button id="increaseFont" class="btn btn-outline-secondary btn-sm me-1">A+</button>
                    <button id="decreaseFont" class="btn btn-outline-secondary btn-sm">A-</button>
                </div>
            </div>
        </div>
    </nav>
    <main class="py-4">
        @yield('content')
    </main>

    <script>
        const body = document.body;
        const darkModeBtn = document.getElementById('darkModeBtn');
        const lightModeBtn = document.getElementById('lightModeBtn');
        const highContrastBtn = document.getElementById('highContrastBtn');
        const returnContrastBtn = document.getElementById('returnContrastBtn');
        const increaseFontBtn = document.getElementById('increaseFont');
        const decreaseFontBtn = document.getElementById('decreaseFont');

        let fontSize = 16; // Domyślny rozmiar czcionki
        let previousMode = ''; // Zmienna do przechowywania poprzedniego trybu

        // Zmiana na ciemny motyw
        darkModeBtn.addEventListener('click', () => {
            body.classList.add('dark-mode');
            body.classList.remove('high-contrast');
            previousMode = 'dark-mode';
            returnContrastBtn.disabled = true;
        });

        // Zmiana na jasny motyw
        lightModeBtn.addEventListener('click', () => {
            body.classList.remove('dark-mode');
            body.classList.remove('high-contrast');
            previousMode = 'light-mode';
            returnContrastBtn.disabled = true;
        });

        // Wysoki kontrast
        highContrastBtn.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                previousMode = 'dark-mode';
            } else if (!body.classList.contains('high-contrast')) {
                previousMode = 'light-mode';
            }
            body.classList.add('high-contrast');
            body.classList.remove('dark-mode');
            returnContrastBtn.disabled = false;
        });

        // Powrót do poprzedniego trybu
        returnContrastBtn.addEventListener('click', () => {
            body.classList.remove('high-contrast');
            if (previousMode === 'dark-mode') {
                body.classList.add('dark-mode');
            }
            returnContrastBtn.disabled = true;
        });

        // Zwiększanie czcionki
        increaseFontBtn.addEventListener('click', () => {
            fontSize += 2;
            body.style.fontSize = fontSize + 'px';
        });

        // Zmniejszanie czcionki
        decreaseFontBtn.addEventListener('click', () => {
            fontSize = Math.max(12, fontSize - 2); // Minimalny rozmiar czcionki to 12px
            body.style.fontSize = fontSize + 'px';
        });
    </script>
</body>
</html>
