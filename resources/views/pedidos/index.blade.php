@extends('layouts.admin-app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Incluye toastr para notificaciones (opcional) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
                <span class="badge {{ $pedido->estado === 'pendiente' ? 'bg-warning' : 
                      ($pedido->estado === 'completado' ? 'bg-success' : 'bg-danger') }}">
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
                    
                    @if($pedido->estado !== 'completado')
                    <button type="button" class="btn btn-sm btn-success" 
                            onclick="actualizarEstado({{ $pedido->id }}, 'completado')"
                            title="Marcar como completado">
                        <i class="bi bi-check-lg"></i>
                    </button>
                    @endif
                    
                    @if($pedido->estado !== 'cancelado')
                    <button type="button" class="btn btn-sm btn-danger" 
                            onclick="actualizarEstado({{ $pedido->id }}, 'cancelado')"
                            title="Cancelar pedido">
                        <i class="bi bi-x-lg"></i>
                    </button>
                    @endif
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
                      {{ $detalle->producto->name }} 
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
    if (confirm(`¿Estás seguro de marcar el pedido #${pedidoId} como ${nuevoEstado}?`)) {
        fetch(`/pedidos/${pedidoId}/actualizar-estado`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ estado: nuevoEstado })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Encuentra la fila por el ID del pedido
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    if (row.cells[0].textContent === `#${pedidoId}`) {
                        // Actualiza el badge de estado
                        const estadoBadge = row.cells[3].querySelector('span.badge');
                        estadoBadge.className = `badge ${data.badge_class}`;
                        estadoBadge.textContent = data.nuevo_estado.charAt(0).toUpperCase() + data.nuevo_estado.slice(1);
                        
                        // Actualiza los botones según el nuevo estado
                        const btnGroup = row.cells[5].querySelector('.btn-group');
                        if (nuevoEstado === 'completado') {
                            btnGroup.querySelector('.btn-success').remove();
                        } else if (nuevoEstado === 'cancelado') {
                            btnGroup.querySelector('.btn-danger').remove();
                        }
                    }
                });
                
                toastr.success(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error(error.message || 'Ocurrió un error al actualizar el estado');
        });
    }
}
</script>
@endsection