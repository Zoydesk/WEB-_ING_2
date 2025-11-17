@extends('layouts.app')
@section('content')
<div class="card glass shadow-sm mb-3">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h1 class="h3 mb-0">Vehículos</h1>
      <span class="text-secondary">Micromovilidad limpia y divertida</span>
    </div>
    <form method="get" action="{{ route('vehicles.index') }}" class="row g-3 align-items-end">
      <div class="col-sm-6 col-md-3">
        <label class="form-label">Categoría</label>
        <select name="category" class="form-select form-select-lg">
          <option value="">Todas</option>
          @foreach(['SCOOTER_ELECTRICO'=>'Scooter eléctrico','BICI'=>'Bicicleta','MOTO_ELECTRICA'=>'Moto eléctrica','PATINES'=>'Patines'] as $val=>$label)
            <option value="{{ $val }}" @selected(request('category')===$val)>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-6 col-md-3">
        <label class="form-label">Marca</label>
        <input name="brand" class="form-control form-control-lg" value="{{ request('brand') }}" placeholder="EcoMove, VoltMoto">
      </div>
      <div class="col-6 col-md-2">
        <label class="form-label">Precio min</label>
        <input type="number" step="0.01" name="min_price" class="form-control form-control-lg" value="{{ request('min_price') }}">
      </div>
      <div class="col-6 col-md-2">
        <label class="form-label">Precio máx</label>
        <input type="number" step="0.01" name="max_price" class="form-control form-control-lg" value="{{ request('max_price') }}">
      </div>
      <div class="col-6 col-md-2">
        <label class="form-label">Inicio</label>
        <input type="datetime-local" name="start_at" class="form-control form-control-lg" value="{{ request('start_at') }}">
      </div>
      <div class="col-12 col-md-auto">
        <button class="btn btn-primary btn-lg">Filtrar</button>
      </div>
    </form>
  </div>
</div>

<div class="row g-3">
@foreach($vehicles as $v)
  <div class="col-sm-6 col-lg-3">
    <div class="card glass h-100">
      @php
        $tags = match($v->category){
          'SCOOTER_ELECTRICO' => 'electric scooter,city',
          'BICI' => 'bicycle,urban,cycle',
          'MOTO_ELECTRICA' => 'electric motorcycle,ev,bike',
          'PATINES' => 'inline skates,rollerblades,urban',
          default => 'micro mobility,urban'
        };
        $seed = $v->id . '-' . substr(strtolower($v->name),0,6);
      @endphp
      <img class="vehicle-img" src="https://source.unsplash.com/random/600x338/?{{ urlencode($tags) }}&sig={{ md5($seed) }}"
           onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ md5($seed) }}/600/338';">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-1">
          <h5 class="card-title mb-0">{{ $v->name }}</h5>
          <span class="badge text-bg-secondary">{{ $v->category_label }}</span>
        </div>
        <p class="text-secondary mb-1">{{ $v->brand }}</p>
        <p class="mb-3">Precio/hora: <span class="fw-semibold">${{ number_format(optional($v->rate)->hour_price,2) }}</span></p>
        <div class="d-flex gap-2">
          <a class="btn btn-outline-light btn-sm" href="{{ route('vehicles.show',$v) }}">Ver detalles</a>
          @auth
            <a class="btn btn-primary btn-sm" href="{{ route('reservations.create',$v) }}">Reservar</a>
          @else
            <a class="btn btn-primary btn-sm" href="{{ route('login') }}">Ingresar para reservar</a>
          @endauth
        </div>
      </div>
    </div>
  </div>
@endforeach
</div>

<div class="mt-3">
  {{ $vehicles->links() }}
</div>
@endsection
