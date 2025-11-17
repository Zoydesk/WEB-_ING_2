@extends('layouts.app')
@section('content')
<div class="card glass">
  <div class="card-body">
    <h1 class="h4 mb-3">Añadir vehículo</h1>
    <form method="post" action="{{ route('admin.vehicles.store') }}" class="row g-3">
      @csrf
      <div class="col-md-6">
        <label class="form-label">Nombre</label>
        <input name="name" class="form-control form-control-lg" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Marca</label>
        <input name="brand" class="form-control form-control-lg" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Categoría</label>
        <select name="category" class="form-select form-select-lg" required>
          <option value="SCOOTER_ELECTRICO">Scooter eléctrico</option>
          <option value="BICI">Bicicleta</option>
          <option value="MOTO_ELECTRICA">Moto eléctrica</option>
          <option value="PATINES">Patines</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">Precio hora</label>
        <input name="hour_price" type="number" step="0.01" class="form-control form-control-lg" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Stock</label>
        <input name="stock" type="number" min="0" class="form-control form-control-lg" value="3" required>
      </div>
      <div class="col-12">
        <label class="form-label">Descripción</label>
        <input name="description" class="form-control form-control-lg">
      </div>
      <div class="col-12">
        <button class="btn btn-primary btn-lg">Guardar</button>
      </div>
    </form>
  </div>
</div>
@endsection
