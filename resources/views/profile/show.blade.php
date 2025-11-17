@extends('layouts.app')
@section('content')
<h1 class="mb-3">Mi perfil</h1>

<div class="row g-3">
  <div class="col-lg-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <p class="mb-1">{{ $user->name }}</p>
        <p class="text-secondary">{{ $user->email }}</p>
        <hr>
        <h5>Agregar método de pago (simulado)</h5>
        <form method="post" action="{{ route('profile.payment.store') }}" class="row g-3">
          @csrf
          <div class="col-12">
            <label class="form-label">Número</label>
            <input name="card_number" class="form-control" required placeholder="4242 4242 4242 4242">
          </div>
          <div class="col-12">
            <label class="form-label">Marca (opcional)</label>
            <input name="brand" class="form-control" placeholder="VISA/Mastercard">
          </div>
          <div class="col-12">
            <button class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h5>Métodos guardados</h5>
        @if($methods->count())
          <ul class="list-group list-group-flush">
            @foreach($methods as $m)
              <li class="list-group-item bg-transparent text-light d-flex justify-content-between">
                <span>{{ $m->brand }}</span>
                <span>**** {{ $m->last4 }}</span>
              </li>
            @endforeach
          </ul>
        @else
          <div class="text-secondary">No tienes métodos guardados.</div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
