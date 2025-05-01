@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <h1>Bienvenido a nuestra tienda</h1>
    @guest
        <p>Regístrate para comprar</p>
    @endguest
@endsection