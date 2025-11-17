<!doctype html>
<html data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Micromovilidad por Horas</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    :root{ --blur:10px; }
    body{
      background:
        radial-gradient(1200px 600px at 10% -10%, rgba(124,92,255,.20) 0%, transparent 60%),
        radial-gradient(900px 500px at 90% 0%, rgba(24,210,255,.18) 0%, transparent 60%),
        linear-gradient(180deg, #0b0e22 0%, #0a0c1b 100%) !important;
    }
    .hero{ background: rgba(255,255,255,.03); border-radius: .75rem; padding: 1rem; }
    .glass{ background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.18); box-shadow: 0 20px 40px rgba(0,0,0,.35); backdrop-filter: blur(var(--blur)); }
    .vehicle-img{width:100%;aspect-ratio:16/9;object-fit:cover;border-radius:.6rem}
    .container-wide{ max-width: 1200px; }
  </style>
</head>
<body class="bg-dark-subtle">

<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom sticky-top">
  <div class="container container-wide">
    <a class="navbar-brand fw-semibold" href="{{ route('home') }}">Micromovilidad</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="" data-bs-target="#navMain"
            aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navMain" class="navbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('vehicles.index') }}">Vehículos</a></li>
      </ul>

      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item me-2"><a class="btn btn-outline-light" href="{{ route('login') }}">Ingresar</a></li>
          <li class="nav-item"><a class="btn btn-primary" href="{{ route('register') }}">Registro</a></li>
        @endguest
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ route('reservations.my') }}">Mis reservas</a></li>
              <li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>
              @can('worker')
                <li><a class="dropdown-item" href="{{ route('worker.dashboard') }}">Trabajador</a></li>
              @endcan
              @can('admin')
                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin</a></li>
              @endcan
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="{{ route('logout') }}" method="post" class="px-3">@csrf
                  <button class="btn btn-sm btn-outline-danger w-100">Salir</button>
                </form>
              </li>
            </ul>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<main class="container container-wide py-4 hero">
  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif
  @yield('content')
  <hr class="my-4">
  <p class="text-secondary small">Hecho con ❤ para un planeta más verde</p>
</main>

</body>
</html>
