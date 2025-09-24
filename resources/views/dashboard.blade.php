@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <!-- Estadísticas generales -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-gray-500">Usuarios</h2>
            <p class="text-xl font-bold">{{ $stats['usuarios'] }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-gray-500">Productos</h2>
            <p class="text-xl font-bold">{{ $stats['productos'] }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-gray-500">Materias Primas</h2>
            <p class="text-xl font-bold">{{ $stats['materias_primas'] }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-gray-500">Órdenes</h2>
            <p class="text-xl font-bold">{{ $stats['ordenes'] }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded text-center">
            <h2 class="text-gray-500">Detalles</h2>
            <p class="text-xl font-bold">{{ $stats['detalles'] }}</p>
        </div>
    </div>

    <!-- Gráfico: Órdenes por mes y estado -->
    <div class="mb-8 bg-white shadow rounded p-4">
        <h2 class="text-lg font-semibold mb-4">Órdenes por Mes y Estado</h2>
        <canvas id="ordenesMesEstadoChart"></canvas>
    </div>

    <!-- Gráfico: Productos en stock -->
    <div class="bg-white shadow rounded p-4">
        <h2 class="text-lg font-semibold mb-4">Productos en Stock</h2>
        <canvas id="productosStockChart"></canvas>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico Órdenes por mes y estado
    const ctxMesEstado = document.getElementById('ordenesMesEstadoChart').getContext('2d');
    new Chart(ctxMesEstado, {
        type: 'line',
        data: {
            labels: @json($meses),
            datasets: [
                @foreach($dataSeries as $estado => $valores)
                {
                    label: '{{ ucfirst($estado) }}',
                    data: @json($valores),
                    fill: false,
                    borderColor: 'hsl({{ $loop->index * 90 }}, 70%, 50%)',
                    backgroundColor: 'hsl({{ $loop->index * 90 }}, 70%, 50%)',
                    tension: 0.3,
                    pointRadius: 4,
                },
                @endforeach
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } }
        }
    });

    // Gráfico Productos en stock
    const productos = @json($productos);
    const stock = @json($stock);

    const ctxProductos = document.getElementById('productosStockChart').getContext('2d');
    new Chart(ctxProductos, {
        type: 'bar',
        data: {
            labels: productos,
            datasets: [{
                label: 'Stock',
                data: stock,
                backgroundColor: 'hsl(200, 70%, 50%)'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
