@extends('layouts.app')

@section('content')


<div class="contenedor"><h1>Bienvenido, {{ Auth::user()->name }}</h1>


   <div class="container d-flex flex-wrap gap-4">
    @foreach($products as $product)
        <x-product-card :product="$product" />
    @endforeach
</div>

@endsection
<style>
    .contenedor{
        margin: 20px
    }
</style>
