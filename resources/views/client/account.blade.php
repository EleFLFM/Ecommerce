@extends('layouts.app')

@section('title', 'Mi Cuenta')

@section('content')
    <h1>Bienvenido, {{ auth()->user()->name }}</h1>
    <div class="client-options">
        <a href="{{ route('profile.edit') }}">Editar perfil</a>
        <a href="#">Mis pedidos</a>
    </div>
@endsection