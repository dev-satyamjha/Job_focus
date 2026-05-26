<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Focus</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('Assets/favicon.png') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 border-bottom border-success border-3 mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-success fs-3" href="{{ route('frontend.index') }}">
                Job Focus
            </a>

            <div class="d-flex gap-2 ms-auto">
                <a href="{{ route('frontend.submit') }}" class="btn btn-success fw-bold shadow-sm">
                    <span style="font-size: 1.2rem; line-height: 1;">+</span> Submit Post
                </a>

                <a href="{{ route('login') }}" class="btn btn-outline-success d-flex align-items-center shadow-sm" title="Admin Login">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="container mb-4">
            <div class="alert alert-success bg-success text-white border-0 shadow-sm alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
