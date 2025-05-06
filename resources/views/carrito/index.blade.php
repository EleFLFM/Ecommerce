@extends('layouts.app')

@section('content')
<div class="container">
    <h2 style="color: aliceblue">Carrito de compras</h2>

    @if(session('carrito') && count(session('carrito')) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($carrito as $id => $item)
                    @php $total += $item['precio'] * $item['cantidad']; @endphp
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>${{ $item['precio'] }}</td>
                        <td>
                            <form action="{{ route('carrito.actualizar') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1">
                                <button type="submit" class="btn btn-sm btn-secondary">Actualizar</button>
                            </form>
                        </td>
                        <td>${{ $item['precio'] * $item['cantidad'] }}</td>
                        <td>
                            <form action="{{ route('carrito.eliminar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 style="color: white">Total: ${{ $total }}</h4>
        <a href="{{ route('home') }}" class="btn btn-primary">Seguir comprando</a>

        <a href="#" class="btn btn-success">Proceder al pago</a>
    @else
        <p>No hay productos en el carrito.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Ir a comprar</a>
    @endif
</div>
@endsection
