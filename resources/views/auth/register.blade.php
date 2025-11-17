@extends('layouts.app')
@section('content')
<h1>Registro</h1>
<div class="card" style="max-width:520px">
  <form method="post" action="/register">@csrf
    <label>Nombre</label><input name="name" required>
    <label>Email</label><input name="email" type="email" required>
    <label>Contraseña</label><input name="password" type="password" required>
    <label>Confirmar</label><input name="password_confirmation" type="password" required>
    <div style="margin-top:12px"><button class="btn">Crear cuenta</button></div>
  </form>
</div>
@endsection
