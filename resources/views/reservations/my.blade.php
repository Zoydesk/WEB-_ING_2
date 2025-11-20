@extends('layouts.app')

@section('content')
<h1 class="mb-3">Mis reservas</h1>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@forelse($reservations as $r)
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="fw-semibold">#{{ $r->id }} • {{ $r->vehicle->name }}</div>
          <div class="text-secondary small">
            {{ $r->start_at->format('d/m/Y H:i') }} → {{ $r->end_at->format('d/m/Y H:i') }}
          </div>
        </div>
        <span class="badge text-bg-secondary">
          {{ $r->status }}
        </span>
      </div>

      <div class="mt-2">
        Estimado:
        <span class="fw-semibold">
          ${{ number_format($r->estimated_total, 2) }}
        </span>
      </div>

      {{-- Mostrar estrellas y comentario si ya hay rating --}}
      @if($r->rating)
        @php
          $fullStars = $r->rating;
        @endphp
        <div class="mt-2">
          Rating:
          @for($i = 1; $i <= 5; $i++)
            @if($i <= $fullStars)
              ★
            @else
              ☆
            @endif
          @endfor
          — {{ $r->rating_comment }}
        </div>
      @endif

      {{-- Si la reserva está FINISHED y no tiene rating, mostrar formulario --}}
      @if($r->status === 'FINISHED' && ! $r->rating)
        <form method="POST" action="{{ route('reservations.rate', $r) }}" class="row g-2 mt-3">
          @csrf
          <div class="col-sm-4">
            <label class="form-label mb-1">Puntuación (1 a 5)</label>
            <select name="rating" class="form-select form-select-sm" required>
              <option value="">Sin calificar</option>
              @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>
          <div class="col-sm-8">
            <label class="form-label mb-1">Comentario (opcional)</label>
            <input name="rating_comment"
                   class="form-control form-control-sm"
                   placeholder="¿Cómo fue la experiencia?">
          </div>
          <div class="col-12">
            <button class="btn btn-outline-primary btn-sm mt-1">
              Enviar reseña
            </button>
          </div>
        </form>
      @endif

      @if($r->status === 'PENDING')
        <a class="btn btn-primary mt-2" href="{{ route('payments.checkout', $r) }}">
          Pagar
        </a>
      @endif
    </div>
  </div>
@empty
  <div class="alert alert-secondary">Aún no tienes reservas.</div>
@endforelse
@endsection
