@extends('layouts.app')
@section('content')
<h1 class="mb-3">Editar {{ $vehicle->name }}</h1>
<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('admin.vehicles.update',$vehicle) }}" class="row g-3">
      @csrf
      <div class="col-md-6">
        <label class="form-label">Nombre</label>
        <input name="name" value="{{ $vehicle->name }}" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Marca</label>
        <input name="brand" value="{{ $vehicle->brand }}" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Categoría</label>
        <select name="category" class="form-select" required>
          @foreach(['SCOOTER_ELECTRICO'=>'Scooter eléctrico','BICI'=>'Bicicleta','MOTO_ELECTRICA'=>'Moto eléctrica','PATINES'=>'Patines'] as $val=>$label)
            <option value="{{ $val }}" @selected($vehicle->category===$val)>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Precio hora</label>
        <input name="hour_price" type="number" step="0.01" value="{{ $vehicle->rate->hour_price }}" class="form-control" required>
      </div>
      <div class="col-12">
        <label class="form-label">Descripción</label>
        <input name="description" value="{{ $vehicle->description }}" class="form-control">
      </div>
      <div class="col-12">
        <button class="btn btn-primary">Actualizar</button>
      </div>
    </form>
  </div>
</div>
@endsection
