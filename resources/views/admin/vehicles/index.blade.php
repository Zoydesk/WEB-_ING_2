@extends('layouts.app')
@section('content')

{{-- Encabezado + acciones --}}
<div class="card glass mb-3">
  <div class="card-body d-flex flex-wrap gap-2 justify-content-between align-items-center">
    <div>
      <h1 class="h4 mb-0">Todos los vehículos</h1>
      <small class="text-secondary">Gestiona catálogo, stock y precios</small>
    </div>
    <div class="d-flex flex-wrap gap-2">
      <a class="btn btn-primary" href="{{ route('admin.vehicles.create') }}">Agregar vehículo</a>
    </div>
  </div>
</div>

{{-- Filtro rápido por nombre/marca/categoría (opcional) --}}
<div class="card glass mb-3">
  <div class="card-body">
    <form method="get" action="{{ route('admin.vehicles.index') }}" class="row g-2 align-items-end">
      <div class="col-sm-6 col-md-4">
        <label class="form-label">Buscar</label>
        <input type="text" name="q" value="{{ request('q') }}" class="form-control"
               placeholder="Nombre, marca o categoría">
      </div>
      <div class="col-sm-6 col-md-3">
        <label class="form-label">Categoría</label>
        <select name="category" class="form-select">
          <option value="">Todas</option>
          @foreach(['SCOOTER_ELECTRICO'=>'Scooter eléctrico','BICI'=>'Bicicleta','MOTO_ELECTRICA'=>'Moto eléctrica','PATINES'=>'Patines'] as $val=>$label)
            <option value="{{ $val }}" @selected(request('category')===$val)>{{ $label }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-light w-100">Filtrar</button>
      </div>
      <div class="col-md-2">
        <a class="btn btn-secondary w-100" href="{{ route('admin.vehicles.index') }}">Limpiar</a>
      </div>
    </form>
  </div>
</div>

{{-- Listado --}}
@forelse($vehicles as $v)
  <div class="card glass mb-2">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
      <div class="d-flex align-items-center gap-3">
        {{-- Imagen temática opcional --}}
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
        <img src="https://source.unsplash.com/random/120x80/?{{ urlencode($tags) }}&sig={{ md5($seed) }}"
             onerror="this.onerror=null;this.src='https://picsum.photos/seed/{{ md5($seed) }}/120/80';"
             style="width:120px;height:80px;object-fit:cover;border-radius:.5rem;border:1px solid rgba(255,255,255,.15)">
        <div>
          <div class="d-flex align-items-center gap-2 flex-wrap">
            <strong class="me-2">{{ $v->name }}</strong>
            <span class="badge text-bg-secondary">{{ $v->category_label }}</span>
          </div>
          <div class="text-secondary small">{{ $v->brand }}</div>
          <div class="mt-1">
            Precio/h: <span class="fw-semibold">${{ number_format(optional($v->rate)->hour_price,2) }}</span>
            <span class="ms-3">
              Stock:
              <span class="{{ $v->stock>0?'text-success':'text-danger' }}">{{ $v->stock }}</span>
            </span>
          </div>
        </div>
      </div>

      <div class="d-flex gap-2">
        <a class="btn btn-outline-light btn-sm" href="{{ route('admin.vehicles.edit',$v) }}">Editar</a>
        <form method="post" action="{{ route('admin.vehicles.destroy',$v) }}">
          @csrf @method('DELETE')
          <button class="btn btn-outline-danger btn-sm"
                  onclick="return confirm('¿Eliminar vehículo {{ $v->name }}?')">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
@empty
  <div class="card glass">
    <div class="card-body">
      <p class="mb-0 text-secondary">No hay vehículos aún. Crea el primero.</p>
      <a class="btn btn-primary mt-2" href="{{ route('admin.vehicles.create') }}">Agregar vehículo</a>
    </div>
  </div>
@endforelse

{{-- Paginación --}}
<div class="mt-3">
  {{ $vehicles->withQueryString()->links() }}
</div>
@endsection
