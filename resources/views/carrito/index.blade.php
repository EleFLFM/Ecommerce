@extends('layouts.app')

@section('content')

    <style>
        .dark-container {
            background-color: #1a202c;
            /* Un gris oscuro agradable */
            color: #edf2f7;
            /* Texto claro */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .dark-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #2d3748;
            /* Un tono más claro para la tabla */
            color: #cbd5e0;
        }

        .dark-table th,
        .dark-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #4a5568;
        }

        .dark-table th {
            background-color: #4a5568;
            color: #fff;
        }

        .dark-table tbody tr:hover {
            background-color: #3b485c;
            /* Un ligero cambio al pasar el mouse */
        }

        .dark-btn-primary {
            background-color: #4299e1;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .dark-btn-primary:hover {
            background-color: #2b6cb0;
        }

        .dark-btn-success {
            background-color: #48bb78;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dark-btn-success:hover {
            background-color: #2f855a;
        }

        .dark-btn-danger {
            background-color: #e53e3e;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dark-btn-danger:hover {
            background-color: #c53030;
        }

        .dark-btn-secondary {
            background-color: #718096;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .dark-btn-secondary:hover {
            background-color: #4a5568;
        }

        .dark-input-number {
            background-color: #4a5568;
            color: #fff;
            border: 1px solid #718096;
            border-radius: 4px;
            padding: 4px;
            width: 60px;
        }

        .swal2-dark .swal2-popup {
            background-color: #2d3748 !important;
            color: #cbd5e0 !important;
        }

        .swal2-dark .swal2-title {
            color: #fff !important;
        }

        .swal2-dark .swal2-content {
            color: #cbd5e0 !important;
        }

        .swal2-dark .swal2-confirm-button {
            background-color: #48bb78 !important;
            color: #fff !important;
        }

        .swal2-dark .swal2-cancel-button {
            background-color: #e53e3e !important;
            color: #fff !important;
        }
    </style>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar',
                background: '#2d3748', // Fondo oscuro para el popup
                color: '#cbd5e0', // Texto claro
                confirmButtonColor: '#48bb78'
            });
        </script>
    @endif
    <script>
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Error al confirmar el pedido',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        @endif
    </script>



    <div class="container">
        <h2>Carrito de compras</h2>

        @if (session('carrito') && count(session('carrito')) > 0)
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Color</th>
                            <th>Talla</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($carrito as $id => $item)
                            @php $total += $item['precio'] * $item['cantidad']; @endphp
                            <tr>
                                <td>{{ $item['nombre'] }}</td>
                                <td>${{ $item['precio'] }}</td>
                                <td>{{ $item['color'] }}</td>
                                <td>{{ $item['talla'] }}</td>
                                <td>
                                    <form action="{{ route('carrito.actualizar') }}" method="POST"
                                        class="d-inline auto-submit-form">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1"
                                            class="input-number" onchange="this.form.submit();">
                                    </form>

                                </td>
                                <td>${{ $item['precio'] * $item['cantidad'] }}</td>
                                <td>
                                    <form action="{{ route('carrito.eliminar') }}" method="POST" class="form-eliminar">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="dark-btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <h4 style="color: #fff; margin: 15px">Total: ${{ $total }}</h4>
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}" class="dark-btn-primary me-2">Seguir comprando</a>
                <form action="{{ route('pedido.confirmar') }}" method="POST">
                    @csrf
                    <button type="submit" class="dark-btn-success">Confirmar pedido</button>
                </form>
            </div>
        @else
            <p style="color: #cbd5e0;">No hay productos en el carrito.</p>
            <a href="{{ route('home') }}" class="dark-btn-primary">Ir a comprar</a>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.form-eliminar');

            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción eliminará el producto del carrito.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e53e3e',
                        cancelButtonColor: '#718096',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                         // Fondo oscuro para el popup
                         // Texto claro

                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Aplicar el tema oscuro de SweetAlert2
            Swal.getPopup().classList.add('swal2-dark');
        });
    </script>
@endsection
