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
            background-color: #1a202c;
            /* Gris oscuro */
            color: #edf2f7;
            /* Texto claro */
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
            background-color: #2d3748;
            /* Un tono más claro para las tarjetas */
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

        .dark-table th,
        .dark-table td {
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
            color: #f0fff4;
            /* Un verde claro para resaltar */
        }

        .dark-empty-message {
            color: #cbd5e0;
        }
    </style>

    <div class="container">
        <h2 class="text-primary">Mis Pedidos</h2>

        @if ($pedidos->isEmpty())
            <p class="text-muted">No has realizado ningún pedido todavía.</p>
        @else
            @foreach ($pedidos as $pedido)
                <div class="light-card">
                    <div class="light-card-header">
                        <strong class="text-dark">Pedido #{{ $pedido->id }}</strong>
                        <span><strong class="text-dark">Estado:</strong> {{ ucfirst($pedido->estado) }}</span>
                    </div>
                    <div class="light-card-body">
                        <p><strong class="text-dark">Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong class="text-dark">Total:</strong> ${{ number_format($pedido->total, 2) }}</p>

                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th>Talla</th>
                                    <th>Color</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pedido->detalles as $detalle)
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

        <div class="d-flex align-items-center mt-3">
            <a href="{{ route('home') }}" class="btn btn-outline-primary me-2">Seguir comprando</a>
        </div>
    </div>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --light-bg: #f8f9fa;
            --card-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            padding: 20px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2.text-primary {
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eaeaea;
            color: var(--secondary-color) !important;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        h2.text-primary:before {
            content: '\f291';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.8rem;
        }

        .light-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 25px;
            overflow: hidden;
            transition: var(--transition);
            border: none;
        }

        .light-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .light-card-header {
            background: linear-gradient(120deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 18px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eaeaea;
        }

        .light-card-header strong {
            font-size: 1.2rem;
            color: #2d3748;
        }

        .light-card-body {
            padding: 25px;
        }

        .light-card-body p {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
        }

        .light-card-body strong {
            color: #4a5568;
            min-width: 70px;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table thead {
            background: linear-gradient(120deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .table th {
            border: none;
            padding: 15px 12px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 15px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #edf2f7;
        }

        .table tbody tr {
            transition: var(--transition);
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 20px;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
            color: white;
        }

        .text-muted {
            text-align: center;
            padding: 50px 20px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            font-size: 1.2rem;
        }

        .text-muted:before {
            content: '\f217';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 4rem;
            color: #cbd5e0;
            display: block;
            margin-bottom: 20px;
        }

        /* Estados de pedido */
        .estado-badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: capitalize;
        }

        .estado-pendiente {
            background-color: #ffeeba;
            color: #856404;
        }

        .estado-procesando {
            background-color: #b8daff;
            color: #004085;
        }

        .estado-enviado {
            background-color: #c3e6cb;
            color: #155724;
        }

        .estado-entregado {
            background-color: #d4edda;
            color: #155724;
        }

        .estado-cancelado {
            background-color: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .light-card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table {
                min-width: 600px;
            }
        }
    </style>
@endsection
