@extends('layouts.app')
@section('content')
<div class="card glass">
  <div class="card-body">
    <h1 class="h3 mb-3">Checkout Reserva #{{ $reservation->id }}</h1>
    <p>Vehículo: <strong>{{ $reservation->vehicle->name }}</strong> • Estimado: <strong>${{ number_format($reservation->estimated_total,2) }}</strong></p>
    <form method="post" action="{{ route('payments.process',$reservation) }}" class="row g-3">
      @csrf
      <div class="col-12">
        <label class="form-label">Número</label>
        <input name="card_number" class="form-control form-control-lg" required placeholder="4242 4242 4242 4242">
      </div>
      <div class="col-md-6">
        <label class="form-label">Titular</label>
        <input name="card_holder" class="form-control form-control-lg" required placeholder="Nombre Apellido">
      </div>
      <div class="col-md-3">
        <label class="form-label">Expiración</label>
        <input name="exp" class="form-control form-control-lg" required placeholder="MM/AA">
      </div>
      <div class="col-md-3">
        <label class="form-label">CVC</label>
        <input name="cvc" class="form-control form-control-lg" required placeholder="123">
      </div>
      <div class="col-12 d-grid d-md-inline">
        <button class="btn btn-primary btn-lg">Pagar y Guardar</button>
      </div>
    </form>
  </div>
</div>
@endsection
