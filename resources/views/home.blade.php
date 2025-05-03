@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <h1>Bienvenido a nuestra tienda</h1>
    @guest
    <x-product-card/>
    @endguest
@endsection