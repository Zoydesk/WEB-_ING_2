@extends('layouts.app')
@section('content')
<h1 class="mb-3">Entrega Reserva #{{ $reservation->id }}</h1>
<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="">
      @csrf
      <p>Confirmar entrega del vehículo <strong>{{ $reservation->vehicle->name }}</strong></p>
      <button class="btn btn-primary">Confirmar Entrega</button>
    </form>
  </div>
</div>
@endsection
