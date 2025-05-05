@extends('layouts.app')

@section('content')


<div class="contenedor">

   <div class="container d-flex flex-wrap gap-4">
    @foreach($products as $product)
    <a style="text-decoration: none;" href="{{ route('productos.show', $product->id) }}">
        <x-product-card :product="$product" />
    </a>
    @endforeach
</div>

@endsection
<style>
    .contenedor{
        margin: 20px
    }
</style>
