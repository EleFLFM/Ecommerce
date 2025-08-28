@extends('layouts.admin-app')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Panel de Administración-editado5</h1>
    <p class="mb-5">Bienvenido, {{ Auth::user()->name }}. Aquí tienes un resumen de tu tienda.</p>
    
    <!-- Tarjetas de Resumen -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pedidos</p>
                                <h5 class="font-weight-bolder">{{ $totalPedidos }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="bi bi-cart-check text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pedidos Pendientes</p>
                                <h5 class="font-weight-bolder">{{ $pedidosPendientes }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="bi bi-clock-history text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card bg-dark text-white">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pedidos Completados</p>
                                <h5 class="font-weight-bolder">{{ $pedidosCompletados }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="bi bi-check-circle text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6">
            <div class="card bg-dark text-white">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Clientes Registrados</p>
                                <h5 class="font-weight-bolder">{{ $totalClientes }}</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="bi bi-people text-lg opacity-10"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Gráficos y Tablas -->
    <div class="row mt-4">
        <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="card bg-dark text-white h-100">
                <div class="card-header pb-0 pt-3">
                    <h6>Distribución de Pedidos por Estado</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="estadoChart" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card bg-dark text-white h-100">
                <div class="card-header pb-0 pt-3">
                    <h6>Pedidos por Mes ({{ date('Y') }})</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="mesChart" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sección de Categorías -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h6>Pedidos por Categoría</h6>
            </div>
            <div class="card-body" style="height: 300px;">
                <canvas id="categoriaPedidosChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h6>Productos por Categoría</h6>
            </div>
            <div class="card-body" style="height: 300px;">
                <canvas id="categoriaProductosChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h6>Ventas por Categoría ($)</h6>
            </div>
            <div class="card-body" style="height: 300px;">
                <canvas id="categoriaVentasChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Productos más vendidos -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card bg-dark text-white">
            <div class="card-header">
                <h6>Top 5 Productos Más Vendidos</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Unidades Vendidas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productosMasVendidos as $producto)
                            <tr>
                                <td>{{ $producto->producto }}</td>
                                <td>{{ $producto->total_vendido }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Últimos Pedidos -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-dark text-white">
                <div class="card-header pb-0">
                    <h6>Últimos Pedidos</h6>
                    <p class="text-sm mb-0">
                        <i class="bi bi-arrow-up text-success"></i>
                        <span class="font-weight-bold">5 últimos pedidos</span>
                    </p>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cliente</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                    {{-- <th class="text-secondary opacity-7"></th> --}}
                                </tr>
                            </thead>
                            <tbody class="table-dark">
                                {{-- Aquí se muestran los últimos pedidos --}}
                                @foreach($ultimosPedidos as $pedido)
                                <tr>
                                    <td class="ps-4">#{{ $pedido->id }}</td>
                                    <td>{{ $pedido->usuario->name ?? 'Cliente no encontrado' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $pedido->estado === 'pendiente' ? 'warning' : ($pedido->estado === 'completado' ? 'success' : 'danger') }}">
                                            {{ ucfirst($pedido->estado) }}
                                        </span>
                                    </td>
                                    <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                    <td>${{ number_format($pedido->total, 2) }}</td>
                                    {{-- <td class="align-middle">
                                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para gráficos -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de distribución por estado
       // Gráfico de distribución por estado
const estadoCtx = document.getElementById('estadoChart');
if (estadoCtx) {
    const estadoData = {
        labels: ['Pendiente', 'Cancelado', 'Completado'], // Manualmente en español
        datasets: [{
            data: [4, 1, 1], // Valores directos según tu dd()
            backgroundColor: [
                'rgba(255, 193, 7, 0.8)',  // Amarillo
                'rgba(220, 53, 69, 0.8)',   // Rojo
                'rgba(40, 167, 69, 0.8)'    // Verde
            ],
            borderWidth: 0
        }]
    };
    
    new Chart(estadoCtx, {
        type: 'doughnut',
        data: estadoData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#fff',
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} pedidos`;
                        }
                    }
                }
            }
        }
    });
}

        // Gráfico de pedidos por mes
        // Gráfico de pedidos por mes
const mesCtx = document.getElementById('mesChart');
if (mesCtx) {
    const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    const datosMeses = [0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0, 0]; // Mayo (5) tiene 6 pedidos
    
    new Chart(mesCtx, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Pedidos',
                data: datosMeses,
                backgroundColor: 'rgba(13, 110, 253, 0.7)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { 
                        color: '#fff',
                        stepSize: 1 // Muestra números enteros
                    },
                    grid: { color: 'rgba(255, 255, 255, 0.1)' }
                },
                x: {
                    ticks: { 
                        color: '#fff',
                        maxRotation: 45,
                        minRotation: 45
                    },
                    grid: { color: 'rgba(255, 255, 255, 0.1)' }
                }
            },
            plugins: {
                legend: {
                    labels: { 
                        color: '#fff',
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.raw} pedidos en ${meses[context.dataIndex]}`;
                        }
                    }
                }
            }
        }
    });
}
    });
     // Gráfico de pedidos por categoría
    new Chart(document.getElementById('categoriaPedidosChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($pedidosPorCategoria->pluck('categoria')) !!},
            datasets: [{
                data: {!! json_encode($pedidosPorCategoria->pluck('total')) !!},
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                ]
            }]
        }
    });

    // Gráfico de productos por categoría
    new Chart(document.getElementById('categoriaProductosChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($productosPorCategoria->pluck('categoria')) !!},
            datasets: [{
                data: {!! json_encode($productosPorCategoria->pluck('total')) !!},
                backgroundColor: [
                    '#FF9F40', '#FFCD56', '#47CCD1', '#F7464A', '#949FB1'
                ]
            }]
        }
    });

    // Gráfico de ventas por categoría
    new Chart(document.getElementById('categoriaVentasChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($ventasPorCategoria->pluck('categoria')) !!},
            datasets: [{
                label: 'Ventas ($)',
                data: {!! json_encode($ventasPorCategoria->pluck('total')) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.6)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


@endsection