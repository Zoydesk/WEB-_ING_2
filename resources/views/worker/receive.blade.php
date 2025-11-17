@extends('layouts.app')
@section('content')
<h1 class="mb-3">Devolución Reserva #{{ $reservation->id }}</h1>
<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="" class="row g-3">
      @csrf
      <div class="col-12">
        <p>Confirmar recepción del vehículo <strong>{{ $reservation->vehicle->name }}</strong></p>
      </div>
      <div class="col-md-3">
        <label class="form-label">Puntuación (1 a 5)</label>
        <select name="rating" class="form-select">
          <option value="">Sin calificar</option>
          @for($i=1;$i<=5;$i++)
            <option value="{{ $i }}">{{ $i }}</option>
          @endfor
        </select>
      </div>
      <div class="col-md-9">
        <label class="form-label">Comentario</label>
        <input name="rating_comment" class="form-control" placeholder="¿Cómo fue la experiencia?">
      </div>
      <div class="col-12">
        <button class="btn btn-primary">Confirmar Recepción</button>
      </div>
    </form>
  </div>
</div>
@endsection
