@extends('layouts.app')
@section('content')
<h1>Ingresar</h1>
<div class="card" style="max-width:480px">
  <form method="post" action="/login">@csrf
    <label>Email</label><input name="email" type="email" required>
    <label>Contraseña</label><input name="password" type="password" required>
    <div style="margin-top:12px"><button class="btn">Entrar</button></div>
  </form>
</div>
@endsection
