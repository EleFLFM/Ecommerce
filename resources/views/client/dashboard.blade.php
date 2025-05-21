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
    @if (Route::is('homse'))
        <div class="contenedor">
            @foreach ($categories as $categoria)
                @if ($categoria->products->count())
                    <div id="productosCarrusel" class="carousel slide" data-bs-ride="carousel">
                        <h3 class="mt-5">{{ $categoria->name }}</h3>

                        <div class="carousel-inner">
                            @foreach ($categoria->products as $index => $producto)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $producto->image) }}" class="d-block w-100"
                                        alt="{{ $producto->name }}">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $producto->name }}</h5>
                                        <p>${{ number_format($producto->price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                @endif
            @endforeach
    @endif




    <div class="container d-flex flex-wrap gap-4">
        @foreach ($products as $product)
            <a style="text-decoration: none;" href="{{ route('productos.show', $product->id) }}">
                <x-product-card :product="$product" />
            </a>
        @endforeach
    </div>
@endsection


<style>
    .contenedor {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    #productosCarrusel {
        margin-bottom: 40px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        height: 450px;
        /* Altura fija para mantener consistencia */
        display: flex;
        flex-direction: column;
    }

    #productosCarrusel h3 {
        background: linear-gradient(135deg, #6e8efb, #a777e3);
        color: white;
        padding: 15px 20px;
        margin: 0;
        text-align: center;
        font-size: 1.5rem;
    }

    .carousel-inner {
        flex-grow: 1;
        border-radius: 0 0 15px 15px;
    }

    .carousel-item {
        height: 100%;
        padding: 20px;
        text-align: center;
        transition: transform 0.6s ease;
    }

    .carousel-item img {
        max-height: 250px;
        width: auto;
        margin: 0 auto;
        border-radius: 10px;
        object-fit: contain;
    }

    .carousel-caption {
        position: relative;
        right: auto;
        left: auto;
        bottom: auto;
        padding: 15px;
        color: #333;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        margin-top: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .carousel-caption h5 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .carousel-caption p {
        color: #e74c3c;
        font-weight: bold;
        font-size: 1.2rem;
        margin: 0;
    }

    /* Controles del carrusel */
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 50%;
        height: 40px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0.8;
    }

    .carousel-control-prev {
        left: 10px;
    }

    .carousel-control-next {
        right: 10px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(1);
        width: 20px;
        height: 20px;
    }

    /* Indicadores */
    .carousel-indicators {
        bottom: 10px;
    }

    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.2);
        border: none;
    }

    .carousel-indicators button.active {
        background-color: #6e8efb;
    }
</style>
