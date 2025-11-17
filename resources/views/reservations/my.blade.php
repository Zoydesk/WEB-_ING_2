@extends('layouts.app')
@section('content')
<h1 class="mb-3">Mis reservas</h1>
@forelse($reservations as $r)
  <div class="card shadow-sm mb-3">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <div class="fw-semibold">#{{ $r->id }} • {{ $r->vehicle->name }}</div>
          <div class="text-secondary small">{{ $r->start_at }} → {{ $r->end_at }}</div>
        </div>
        <span class="badge text-bg-secondary">{{ $r->status }}</span>
      </div>
      <div class="mt-2">Estimado: <span class="fw-semibold">${{ number_format($r->estimated_total,2) }}</span></div>
      @if($r->rating)
        <div class="mt-1">Rating: {{ $r->rating }} ★ — {{ $r->rating_comment }}</div>
      @endif
      @if($r->status==='PENDING')
        <a class="btn btn-primary mt-2" href="{{ route('payments.checkout',$r) }}">Pagar</a>
      @endif
    </div>
  </div>
@empty
  <div class="alert alert-secondary">Aún no tienes reservas.</div>
@endforelse
@endsection
