@extends('layouts.app')
@section('content')
<style>
  .auth-hero{
    min-height: calc(100vh - 120px);
    display:grid; place-items:center;
    background:
      radial-gradient(1200px 600px at 10% -10%, rgba(124,92,255,.20) 0%, transparent 60%),
      radial-gradient(900px 500px at 90% 0%, rgba(24,210,255,.18) 0%, transparent 60%);
    border-radius: .75rem;
  }
  .glass{
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.18);
    box-shadow: 0 20px 40px rgba(0,0,0,.35);
    backdrop-filter: blur(10px);
  }
  .input-xl{ padding:14px 16px; font-size:1.05rem; }
</style>

<div class="auth-hero">
  <div class="container">
    <div class="row g-4 align-items-stretch">
      <div class="col-lg-6 d-none d-lg-block">
        <div class="h-100 p-5 glass rounded-4">
          <h1 class="display-5 fw-bold mb-3">Bienvenido de vuelta</h1>
          <p class="lead text-secondary">Alquila scooters, bicis, motos eléctricas y patines por horas con un par de clics.</p>
          <ul class="mt-3 text-secondary">
            <li>Reservas rápidas y seguras</li>
            <li>Entrega en agencia o a domicilio</li>
            <li>Califica tu experiencia</li>
          </ul>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card glass rounded-4">
          <div class="card-body p-4 p-md-5">
            <h2 class="fw-semibold mb-4">Ingresar</h2>

            <form method="post" action="{{ url('/login') }}" class="row g-3">
              @csrf
              <div class="col-12">
                <label class="form-label">Email</label>
                <input name="email" type="email" class="form-control input-xl"
                       value="{{ old('email') }}" required placeholder="tu@email.com">
              </div>
              <div class="col-12">
                <label class="form-label">Contraseña</label>
                <input name="password" type="password" class="form-control input-xl" required placeholder="••••••••">
              </div>
              <div class="col-12 d-flex align-items-center justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember">
                  <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                <button class="btn btn-primary btn-lg px-4">Entrar</button>
              </div>
              @if ($errors->any())
                <div class="alert alert-danger mt-2 mb-0">
                  {{ $errors->first() }}
                </div>
              @endif
            </form>

            <div class="text-center mt-3">
              <span class="text-secondary">¿No tienes cuenta?</span>
              <a class="link-light" href="{{ route('register') }}">Crear una ahora</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
