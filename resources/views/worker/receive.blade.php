@extends('layouts.app')
@section('content')
<h1 class="mb-3">Devolución Reserva #{{ $reservation->id }}</h1>

<div class="card shadow-sm">
  <div class="card-body">
    <p class="mb-2">
      Devolución del vehículo <strong>{{ $reservation->vehicle->name }}</strong> completada con éxito.
    </p>

    <p class="text-secondary mb-3">
      Cliente: {{ $reservation->user->name }}
      • Tel: {{ $reservation->user->phone ?? '—' }}
    </p>

    <p class="mb-3">
      Gracias por registrar la devolución.
      La calificación y el comentario sobre el vehículo deben ser completados por el usuario en su panel.
    </p>

    {{-- Botón para confirmar y actualizar el estado en BD --}}
    <form method="POST" action="{{ route('worker.receive', $reservation) }}">
      @csrf
      <button class="btn btn-success">
        Confirmar recepción
      </button>
    </form>
  </div>
</div>
@endsection
