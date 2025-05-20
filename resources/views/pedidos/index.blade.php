@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2 class="text-white">Gestión de Pedidos</h2>
        </div>
    </div>

    <div class="card bg-dark text-white">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedidos as $pedido)
                        <tr>
                            <td>#{{ $pedido->id }}</td>
                            <td>{{ $pedido->usuario->name ?? 'Usuario no encontrado' }}</td>
                            <td>${{ $pedido->getTotalFormateado() }}</td>
                            <td>
                                <span class="badge bg-{{ $pedido->estado === 'pendiente' ? 'warning' : 
                                    ($pedido->estado === 'completado' ? 'success' : 'danger') }}">
                                    {{ ucfirst($pedido->estado) }}
                                </span>
                            </td>
                            <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-info" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detallesPedido{{ $pedido->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-success" 
                                            onclick="actualizarEstado({{ $pedido->id }}, 'completado')">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="actualizarEstado({{ $pedido->id }}, 'cancelado')">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay pedidos registrados</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($pedidos as $pedido)
<!-- Modal de Detalles -->
<div class="modal fade" id="detallesPedido{{ $pedido->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Pedido #{{ $pedido->id }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Cliente:</strong> {{ $pedido->usuario->name ?? 'Usuario no encontrado' }}</p>
                <p><strong>Email:</strong> {{ $pedido->usuario->email ?? 'Email no disponible' }}</p>
                <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($pedido->estado) }}</p>
                <p><strong>Total:</strong> ${{ $pedido->getTotalFormateado() }}</p>
                
                <h6 class="mt-4">Productos:</h6>
                <ul class="list-group list-group-flush bg-dark">
                    @foreach($pedido->detalles as $detalle)
                    <li class="list-group-item bg-dark text-white">
                        {{ $detalle->producto->nombre }} 
                        <br>
                        Talla: {{ $detalle->talla }} | Color: {{ $detalle->color }}
                        <br>
                        Cantidad: {{ $detalle->cantidad }} x ${{ number_format($detalle->precio_unitario, 2) }}
                        <span class="float-end">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
function actualizarEstado(pedidoId, nuevoEstado) {
    if (confirm('¿Estás seguro de cambiar el estado del pedido?')) {
        // Aquí deberías hacer una llamada AJAX para actualizar el estado
        // Por ahora solo recargamos la página
        window.location.reload();
    }
}
</script>
@endsection