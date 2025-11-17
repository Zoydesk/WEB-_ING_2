@extends('layouts.app')
@section('content')
<div class="card glass mb-3">
  <div class="card-body d-flex justify-content-between align-items-center">
    <h1 class="h4 mb-0">Vehículos</h1>
    <a class="btn btn-primary" href="{{ route('admin.vehicles.create') }}">Añadir vehículo</a>
  </div>
</div>

@foreach($vehicles as $v)
  <div class="card glass mb-2">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div>
        <strong>{{ $v->name }}</strong> • {{ $v->brand }} • {{ $v->category_label }}
        • Precio/h: ${{ number_format(optional($v->rate)->hour_price,2) }}
        • Stock: <span class="{{ $v->stock>0?'text-success':'text-danger' }}">{{ $v->stock }}</span>
      </div>
      <div class="d-flex gap-2">
        <a class="btn btn-outline-light btn-sm" href="{{ route('admin.vehicles.edit',$v) }}">Editar</a>
        <form method="post" action="{{ route('admin.vehicles.destroy',$v) }}">
          @csrf @method('DELETE')
          <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar vehículo?')">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
@endforeach

<div class="mt-3">{{ $vehicles->links() }}</div>
@endsection
