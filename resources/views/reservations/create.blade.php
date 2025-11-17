@extends('layouts.app')
@section('content')
<h1 class="mb-3">Reservar {{ $vehicle->name }}</h1>
<p class="text-secondary">{{ $vehicle->brand }} • {{ $vehicle->category_label }}</p>
<p class="mb-3">Precio por hora: <span class="fw-semibold">${{ number_format($vehicle->rate->hour_price,2) }}</span></p>

<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('reservations.store') }}" class="row g-3">
      @csrf
      <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
      <div class="col-sm-6">
        <label class="form-label">Inicio</label>
        <input name="start_at" type="datetime-local" class="form-control" required>
      </div>
      <div class="col-sm-6">
        <label class="form-label">Fin</label>
        <input name="end_at" type="datetime-local" class="form-control" required>
      </div>
      <div class="col-sm-6 col-md-4">
        <label class="form-label">Modalidad de entrega</label>
        <select name="delivery_mode" class="form-select">
          <option value="AGENCY">Agencia</option>
          <option value="HOME">A domicilio</option>
        </select>
      </div>
      <div class="col-sm-6 col-md-8">
        <label class="form-label">Dirección (si domicilio)</label>
        <input name="delivery_address" class="form-control" placeholder="Calle 123">
      </div>
      <div class="col-12">
        <button class="btn btn-primary">Continuar a pago</button>
      </div>
    </form>
  </div>
</div>
@endsection
