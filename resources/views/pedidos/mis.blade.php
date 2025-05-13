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
<style>
    .dark-container {
        background-color: #1a202c; /* Gris oscuro */
        color: #edf2f7; /* Texto claro */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .dark-heading {
        color: #fff;
        margin-bottom: 20px;
    }

    .dark-card {
        background-color: #2d3748; /* Un tono más claro para las tarjetas */
        color: #cbd5e0;
        border: 1px solid #4a5568;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .dark-card-header {
        background-color: #4a5568;
        color: #fff;
        padding: 12px 20px;
        border-bottom: 1px solid #616e7c;
        border-radius-top-left: 8px;
        border-radius-top-right: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dark-card-body {
        padding: 20px;
    }

    .dark-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .dark-table th, .dark-table td {
        padding: 10px 12px;
        text-align: left;
        border-bottom: 1px solid #4a5568;
    }

    .dark-table th {
        background-color: #616e7c;
        color: #fff;
    }

    .dark-table tbody tr:hover {
        background-color: #3b485c;
    }

    .dark-strong {
        font-weight: bold;
        color: #f0fff4; /* Un verde claro para resaltar */
    }

    .dark-empty-message {
        color: #cbd5e0;
    }
</style>

<div class="container dark-container">
    <h2 class="dark-heading">Mis Pedidos</h2>

    @if($pedidos->isEmpty())
        <p class="dark-empty-message">No has realizado ningún pedido todavía.</p>
    @else
        @foreach($pedidos as $pedido)
            <div class="dark-card">
                <div class="dark-card-header">
                    <strong class="dark-strong">Pedido #{{ $pedido->id }}</strong>
                    <span><strong class="dark-strong">Estado:</strong> {{ ucfirst($pedido->estado) }}</span>
                </div>
                <div class="dark-card-body">
                    <p><strong class="dark-strong">Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong class="dark-strong">Total:</strong> ${{ number_format($pedido->total, 2) }}</p>

                    <table class="dark-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->producto->name ?? 'Producto eliminado' }}</td>
                                    <td>{{ $detalle->talla }}</td>
                                    <td>{{ $detalle->color }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection