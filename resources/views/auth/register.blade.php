@extends('layouts.app')
@section('content')
    <style>
        .auth-hero {
            min-height: calc(100vh - 120px);
            display: grid;
            place-items: center;
            background:
                radial-gradient(1200px 600px at 10% -10%, rgba(124, 92, 255, .20) 0%, transparent 60%),
                radial-gradient(900px 500px at 90% 0%, rgba(24, 210, 255, .18) 0%, transparent 60%);
            border-radius: .75rem;
        }

        .glass {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .18);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .35);
            backdrop-filter: blur(10px);
        }

        .input-xl {
            padding: 14px 16px;
            font-size: 1.05rem;
        }
    </style>

    <div class="auth-hero">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="h-100 p-5 glass rounded-4">
                        <h1 class="display-5 fw-bold mb-3">Crea tu cuenta</h1>
                        <p class="lead text-secondary">Únete a la micromovilidad: rápida, limpia y divertida.</p>
                        <div class="mt-4">
                            <span class="badge text-bg-primary me-2">Scooters</span>
                            <span class="badge text-bg-info me-2">Bicicletas</span>
                            <span class="badge text-bg-success me-2">Motos eléctricas</span>
                            <span class="badge text-bg-secondary">Patines</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card glass rounded-4">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="fw-semibold mb-4">Registro</h2>
                            <form method="post" action="/register" class="row g-3">
                                @csrf
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Nombre</label>
                                    <input name="name" class="form-control input-xl" required placeholder="Tu nombre">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control input-xl" required
                                        placeholder="tu@email.com">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}"
                                        required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label">Contraseña</label>
                                    <input name="password" type="password" class="form-control input-xl" required
                                        placeholder="••••••••">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label">Confirmar</label>
                                    <input name="password_confirmation" type="password" class="form-control input-xl"
                                        required placeholder="••••••••">
                                </div>
                                <div class="col-12 d-grid mt-2">
                                    <button class="btn btn-primary btn-lg py-3">Crear cuenta</button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <span class="text-secondary">¿Ya tienes cuenta?</span>
                                <a class="link-light" href="{{ route('login') }}">Ingresar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
