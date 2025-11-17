@extends('layouts.app')
@section('content')
<h1 class="mb-3">Vehículos</h1>
<a class="btn btn-primary mb-3" href="{{ route('admin.vehicles.create') }}">Nuevo</a>

@foreach($vehicles as $v)
  <div class="card shadow-sm mb-2">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div><strong>{{ $v->name }}</strong> • {{ $v->brand }} • {{ $v->category_label }} • ${{ number_format(optional($v->rate)->hour_price,2) }}</div>
      <div class="d-flex gap-2">
        <a class="btn btn-outline-light btn-sm" href="{{ route('admin.vehicles.edit',$v) }}">Editar</a>
        <form method="post" action="{{ route('admin.vehicles.destroy',$v) }}">
          @csrf @method('DELETE')
          <button class="btn btn-outline-light btn-sm">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
@endforeach

<div class="mt-3">{{ $vehicles->links() }}</div>
@endsection
