@extends('layouts.app')
@section('content')
<div class="card glass">
  <div class="card-body">
    <h1 class="h3 mb-3">Panel Admin</h1>
    <div class="d-flex gap-2 flex-wrap">
      <a class="btn btn-primary" href="{{ route('admin.vehicles.index') }}">Gestionar vehículos</a>
      <!-- Aquí puedes añadir más secciones: usuarios, tarifas, reportes -->
    </div>
  </div>
</div>
@endsection
