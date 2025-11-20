@extends('layouts.app')
@section('content')
    <div class="card glass mb-3">
        <div class="card-body">
            <h1 class="h3 mb-0">Panel de Trabajador</h1>
            <p class="text-secondary mb-0">
                Entregas y recogidas a domicilio programadas para hoy
            </p>
        </div>
    </div>

    {{-- FLASH DE ÉXITO / ERROR --}}
    @if (session('ok'))
        <div class="alert alert-success">
            {{ session('ok') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="row g-3">
        {{-- ENTREGAS A DOMICILIO --}}
        <div class="col-lg-6">
            <div class="card glass">
                <div class="card-body">
                    <h5 class="mb-3">Entregas a domicilio</h5>
                    @forelse($deliveries as $r)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <div class="fw-semibold">{{ $r->vehicle->name }} • #{{ $r->id }}</div>
                                <div class="text-secondary small">
                                    Cliente: {{ $r->user->name }} • Tel: {{ $r->user->phone ?? '—' }}
                                </div>
                                <div class="text-secondary small">
                                    Entrega:
                                    {{ $r->start_at->format('d/m/Y H:i') }}
                                    • Dirección: {{ $r->delivery_address ?? '—' }}
                                </div>
                            </div>
                            <a class="btn btn-primary btn-sm" href="{{ route('worker.deliver', $r) }}">Entregar</a>
                        </div>
                    @empty
                        <div class="text-secondary">No hay entregas a domicilio hoy.</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- RECOGIDAS A DOMICILIO --}}
        <div class="col-lg-6">
            <div class="card glass">
                <div class="card-body">
                    <h5 class="mb-3">Recogidas a domicilio</h5>
                    @forelse($pickups as $r)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <div class="fw-semibold">{{ $r->vehicle->name }} • #{{ $r->id }}</div>
                                <div class="text-secondary small">
                                    Cliente: {{ $r->user->name }} • Tel: {{ $r->user->phone ?? '—' }}
                                </div>
                                <div class="text-secondary small">
                                    Recogida:
                                    {{ $r->end_at->format('d/m/Y H:i') }}
                                    • Dirección: {{ $r->delivery_address ?? '—' }}
                                </div>
                            </div>

                            @if ($r->status === 'FINISHED')
                                {{-- Ya recibido: mostrar botón verde deshabilitado --}}
                                <button class="btn btn-success btn-sm" disabled>
                                    Recibido
                                </button>
                            @else
                                {{-- Aún en curso: permitir recibir --}}
                                <a class="btn btn-outline-light btn-sm" href="{{ route('worker.receive', $r) }}">
                                    Recibir
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="text-secondary">No hay recogidas a domicilio hoy.</div>
                    @endforelse
                </div>
            </div>
        </div>
    @endsection
