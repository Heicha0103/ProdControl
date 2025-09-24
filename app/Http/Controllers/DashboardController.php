<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producto;
use App\Models\MateriaPrima;
use App\Models\OrdenProduccion;
use App\Models\DetalleOrden;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas generales
        $stats = [
            'usuarios' => User::count(),
            'productos' => Producto::count(),
            'materias_primas' => MateriaPrima::count(),
            'ordenes' => OrdenProduccion::count(),
            'detalles' => DetalleOrden::count(),
        ];

        // Agrupar órdenes por mes y estado
        $ordenesPorMesEstado = OrdenProduccion::select(
            DB::raw("DATE_FORMAT(created_at, '%Y-%m') as mes"),
            'estado',
            DB::raw("COUNT(*) as total")
        )
        ->groupBy('mes', 'estado')
        ->orderBy('mes')
        ->get();

        // Transformamos a un formato para Chart.js
        $meses = $ordenesPorMesEstado->pluck('mes')->unique()->values();
        $estados = $ordenesPorMesEstado->pluck('estado')->unique()->values();

        $dataSeries = [];
        foreach ($estados as $estado) {
            $dataSeries[$estado] = [];
            foreach ($meses as $mes) {
                $count = $ordenesPorMesEstado
                    ->where('mes', $mes)
                    ->where('estado', $estado)
                    ->pluck('total')
                    ->first();
                $dataSeries[$estado][] = $count ?? 0;
            }
        }

        // Datos de productos en stock: solo los 10 con mayor stock
        $productosStock = Producto::orderByDesc('stock_actual')
            ->take(10)
            ->get(['nombre', 'stock_actual']);

        $productos = $productosStock->pluck('nombre');
        $stock = $productosStock->pluck('stock_actual');

        // Retornamos la vista con todas las variables
        return view('dashboard', compact(
            'stats',
            'ordenesPorMesEstado',
            'meses',
            'dataSeries',
            'productos',
            'stock'
        ));
    }
}
