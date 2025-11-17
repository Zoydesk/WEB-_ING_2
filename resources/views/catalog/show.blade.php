@extends('layouts.app')
@section('content')
@php
  $tags = match($vehicle->category){
    'SCOOTER_ELECTRICO' => 'electric scooter,city',
    'BICI' => 'bicycle,urban,cycle',
    'MOTO_ELECTRICA' => 'electric motorcycle,ev,bike',
    'PATINES' => 'inline skates,rollerblades,urban',
    default => 'micro mobility,urban'
  };
  $seed = $vehicle->id . '-' . substr(strtolower($vehicle->name),0,6);
@endphp

<div class="row g-4">
  <div class="col-lg-7">
    <img class="vehicle-img"
      src="https://source.unsplash.com/random/1000x560/?{{ urlencode($tags) }}&sig={{ md5($seed) }}"
      onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ md5($seed) }}/1000/560';">
  </div>
  <div class="col-lg-5">
    <h1 class="h3">{{ $vehicle->name }}</h1>
    <p class="text-secondary mb-2">{{ $vehicle->brand }} • <span class="badge text-bg-secondary">{{ $vehicle->category_label }}</span></p>
    <p class="mb-3">{{ $vehicle->description }}</p>
    <p class="fs-5">Precio por hora: <span class="fw-semibold">${{ number_format($vehicle->rate->hour_price,2) }}</span></p>
    @auth
      <a class="btn btn-primary" href="{{ route('reservations.create',$vehicle) }}">Reservar</a>
    @endauth
  </div>
</div>
@endsection
