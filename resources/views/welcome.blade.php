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

        .card.custom-bg-dark {
            background-color: #3c3c3c;
            color: #f8f9fa;
        }

        .card.custom-bg-light {
            background-color: #ffffff;
            color: #212529;
        }

        /* Global font sizes */
        body.font-size-normal, body.font-size-normal * {
    font-size: 18px !important; /* Zwiększenie domyślnej czcionki */
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
        // JavaScript for Accessibility Features
        const body = document.body;
        const darkModeBtn = document.getElementById('darkModeBtn');
        const lightModeBtn = document.getElementById('lightModeBtn');
        const increaseFontBtn = document.getElementById('increaseFontBtn');
        const decreaseFontBtn = document.getElementById('decreaseFontBtn');

        let fontSizeClass = 'font-size-normal'; // Default font size class

        darkModeBtn.addEventListener('click', () => {
            body.classList.add('custom-bg-dark');
            body.classList.remove('custom-bg-light');
        });

        lightModeBtn.addEventListener('click', () => {
            body.classList.add('custom-bg-light');
            body.classList.remove('custom-bg-dark');
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

        // Update font size class
        function updateFontSize() {
            body.classList.remove('font-size-normal', 'font-size-large', 'font-size-xlarge');
            body.classList.add(fontSizeClass);
        }
    </script>
</body>
</html>
