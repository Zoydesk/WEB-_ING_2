@extends('layouts.app')
@section('content')
<h1 class="mb-3">Nuevo vehículo</h1>
<div class="card shadow-sm">
  <div class="card-body">
    <form method="post" action="{{ route('admin.vehicles.store') }}" class="row g-3">
      @csrf
      <div class="col-md-6">
        <label class="form-label">Nombre</label>
        <input name="name" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Marca</label>
        <input name="brand" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Categoría</label>
        <select name="category" class="form-select" required>
          <option value="SCOOTER_ELECTRICO">Scooter eléctrico</option>
          <option value="BICI">Bicicleta</option>
          <option value="MOTO_ELECTRICA">Moto eléctrica</option>
          <option value="PATINES">Patines</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Precio hora</label>
        <input name="hour_price" type="number" step="0.01" class="form-control" required>
      </div>
      <div class="col-12">
        <label class="form-label">Descripción</label>
        <input name="description" class="form-control">
      </div>
      <div class="col-12">
        <button class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
</div>
@endsection
