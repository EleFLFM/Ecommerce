@extends('layouts.app')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
<div class="contenedor">

   <div class="container d-flex flex-wrap gap-4">
    @foreach($products as $product)
    <a style="text-decoration: none;" href="{{ route('productos.show', $product->id) }}">
        <x-product-card :product="$product" />
    </a>
    @endforeach
    <a href="{{ route('pedidos.mis') }}" class="btn btn-outline-primary">
        🧾 Ver mis pedidos
    </a>
    
</div>

@endsection
<style>
    .contenedor{
        margin: 20px
    }
</style>
