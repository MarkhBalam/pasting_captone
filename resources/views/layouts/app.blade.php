<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Capstone' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f7f7f9; }
        .navbar-brand { font-weight: 700; letter-spacing: .3px; }
        .card { border: 0; border-radius: 1rem; box-shadow: 0 6px 18px rgba(0,0,0,.06); }
        .btn { border-radius: .75rem; }
        .table thead th { background: #f0f2f5; }
        .badge-soft { background: #eef3ff; color: #3155d0; }

        /* Nav styling */
        .nav-pills .nav-link {
            border-radius: .75rem;
            font-weight: 500;
            color: #444;
            background-color: #f8f9fa;
            transition: all 0.2s ease-in-out;
        }
        .nav-pills .nav-link:hover {
            background-color: #e9ecef;
            color: #000;
        }
        .nav-pills .nav-link.active {
            background-color: #0d6efd;
            color: #fff !important;
            font-weight: 600;
        }
        .nav-link i { margin-right: .35rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ route('projects.index') }}">
      <i class="bi bi-kanban"></i> Capstone
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="topnav" class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto nav-pills gap-2">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
            <i class="bi bi-folder"></i> Projects
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('participants.*') ? 'active' : '' }}" href="{{ route('participants.index') }}">
            <i class="bi bi-people"></i> Participants
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('programs.*') ? 'active' : '' }}" href="{{ route('programs.index') }}">
            <i class="bi bi-journal-text"></i> Programs
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('facilities.*') ? 'active' : '' }}" href="{{ route('facilities.index') }}">
            <i class="bi bi-building"></i> Facilities
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">
            <i class="bi bi-tools"></i> Services
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('equipment.*') ? 'active' : '' }}" href="{{ route('equipment.index') }}">
            <i class="bi bi-cpu"></i> Equipment
          </a>
        </li>
      </ul>
      <a href="{{ route('outcomes.index') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center">
        <i class="bi bi-graph-up"></i> Outcomes
      </a>
    </div>
  </div>
</nav>

<main class="container my-4">
    @include('shared.flash')
    {{ $slot ?? '' }}
    @yield('content')
</main>

{{-- Global Delete Modal --}}
@includeIf('shared.delete-modal')

{{-- Bootstrap JS + Toasts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@includeIf('shared.toasts')

{{-- HTML5 client-side validation helper --}}
<script>
(function () {
  'use strict';
  document.querySelectorAll('form.needs-validation').forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) { event.preventDefault(); event.stopPropagation(); }
      form.classList.add('was-validated');
    }, false);
  });
})();
</script>
</body>
</html>
