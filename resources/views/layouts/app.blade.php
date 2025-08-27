<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Capstone' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f7f7f9; }
        .navbar-brand { font-weight: 700; letter-spacing: .3px; }
        .card { border: 0; border-radius: 1rem; box-shadow: 0 6px 18px rgba(0,0,0,.06); }
        .btn { border-radius: .75rem; }
        .table thead th { background: #f0f2f5; }
        .badge-soft { background: #eef3ff; color: #3155d0; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('projects.index') }}">Capstone</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="topnav" class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('projects.index') }}">Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('participants.index') }}">Participants</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('programs.index') }}">Programs</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('facilities.index') }}">Facilities</a></li>
            </ul>
            <a href="{{ route('outcomes.index') }}" class="btn btn-outline-primary btn-sm">Outcomes</a>
        </div>
    </div>
</nav>

<main class="container my-4">
    @include('shared.flash')
    {{ $slot ?? '' }}
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
