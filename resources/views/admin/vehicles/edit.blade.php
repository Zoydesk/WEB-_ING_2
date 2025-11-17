@extends('layouts.app')
@section('content')
    <div class="card glass">
        <div class="card-body">
            <h1 class="h4 mb-3">Editar {{ $vehicle->name }}</h1>
            <form method="post" action="{{ route('admin.vehicles.update', $vehicle) }}" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input name="name" class="form-control form-control-lg" value="{{ $vehicle->name }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Marca</label>
                    <input name="brand" class="form-control form-control-lg" value="{{ $vehicle->brand }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Categoría</label>
                    <select name="category" class="form-select form-select-lg" required>
                        @foreach (['SCOOTER_ELECTRICO' => 'Scooter eléctrico', 'BICI' => 'Bicicleta', 'MOTO_ELECTRICA' => 'Moto eléctrica', 'PATINES' => 'Patines'] as $val => $label)
                            <option value="{{ $val }}" @selected($vehicle->category === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Precio hora</label>
                    <input name="hour_price" type="number" step="0.01" class="form-control form-control-lg"
                        value="{{ $vehicle->rate->hour_price }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Stock</label>
                    <input name="stock" type="number" min="0" class="form-control form-control-lg"
                        value="{{ $vehicle->stock }}" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Descripción</label>
                    <input name="description" class="form-control form-control-lg" value="{{ $vehicle->description }}">
                </div>
                <div class="col-12">
                    <button class="btn btn-primary btn-lg">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
