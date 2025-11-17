@extends('layouts.app')
@section('content')
<h1 class="mb-3">Panel Admin</h1>
<a class="btn btn-primary" href="{{ route('admin.vehicles.index') }}">Gestionar vehículos</a>
@endsection
