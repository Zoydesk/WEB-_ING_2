@extends('layouts.app')
@section('content')
<div class="card glass">
  <div class="card-body">
    <h1 class="h3 mb-3">Reservar {{ $vehicle->name }}</h1>
    <p class="text-secondary">{{ $vehicle->brand }} • {{ $vehicle->category_label }}</p>
    <p>Precio por hora: <span class="fw-semibold">${{ number_format($vehicle->rate->hour_price, 2) }}</span></p>

    <form method="post" action="{{ route('reservations.store') }}" class="row g-3">
      @csrf
      <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

      <div class="col-sm-6">
        <label class="form-label">Inicio</label>
        <input name="start_at" type="datetime-local" class="form-control form-control-lg" required>
      </div>
      <div class="col-sm-6">
        <label class="form-label">Fin</label>
        <input name="end_at" type="datetime-local" class="form-control form-control-lg" required>
      </div>

      <div class="col-sm-6 col-md-4">
        <label class="form-label">Modalidad</label>
        <select name="delivery_mode" class="form-select form-select-lg">
          <option value="AGENCY">Agencia</option>
          <option value="HOME">A domicilio</option>
        </select>
      </div>
      <div class="col-sm-6 col-md-8">
        <label class="form-label">Dirección (si domicilio)</label>
        <input name="delivery_address" class="form-control form-control-lg" placeholder="Calle 123">
      </div>

      <div class="col-12 d-grid d-md-inline">
        <button class="btn btn-primary btn-lg">Continuar a pago</button>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger mt-2">{{ $errors->first() }}</div>
      @endif
    </form>
  </div>
</div>
@endsection
