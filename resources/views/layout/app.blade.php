{{-- TODO-4-3, TODO-4-4, TODO-4-5 : layout de base avec @yield("content") --}}
{{-- TODO-4-9 : lien vers books | TODO-7-3 : lien vers order --}}
{{-- TODO-5-7 : affichage des messages de confirmation --}}
{{-- TODO-9-0 : import des icones Bootstrap --}}
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Library</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
    />
</head>
    <body>
        <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Home</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.index') }}">Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.order') }}">Order</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-3">
        @if ($message = Session::get('success'))
            <div class="alert alert-success"><p>{{ $message }}</p></div>
        @endif

        @yield('content')
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
