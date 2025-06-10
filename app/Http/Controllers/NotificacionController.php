<?php

// app/Http/Controllers/NotificacionController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensajesARegente;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificacionController extends Controller
{
      public function index()
    {
        // Lógica para devolver una vista o datos
        return view('dashboar');
    }
    public function obtener()
    {
        $notificaciones = MensajesARegente::orderBy('created_at', 'desc')->get(['mensaje', 'created_at']);
        return response()->json($notificaciones);
    }

    public function guardar(Request $request)
    {
        $request->validate(['mensaje' => 'required|string']);
        $mensaje = MensajesARegente::create(['mensaje' => $request->mensaje]);
        return response()->json(['status' => 'success', 'mensaje' => 'Notificación guardada.']);
    }

    public function eliminar(Request $request)
    {
        $request->validate(['mensaje' => 'required|string']);
        $eliminado = MensajesARegente::where('mensaje', $request->mensaje)->delete();
        return response()->json(['status' => $eliminado ? 'success' : 'error']);
    }

    public function sistema()
    {
        // Simula la lógica de vencimientos y stock como en tu PHP
        $productos = DB::table('producto')->get();
        $now = Carbon::now();
        $notificaciones = [];

        foreach ($productos as $producto) {
            if ($producto->Fecha_Vencimiento) {
                $fechaVencimiento = Carbon::parse($producto->Fecha_Vencimiento);

                if ($fechaVencimiento->isPast()) {
                    $notificaciones[] = "El producto '{$producto->Nombre_Producto}' ha vencido.";
                } elseif ($fechaVencimiento->diffInDays($now) <= 7 && $fechaVencimiento > $now) {
                    $notificaciones[] = "El producto '{$producto->Nombre_Producto}' está por vencer en una semana ({$fechaVencimiento->toDateString()}).";
                }
            }

            if ($producto->Cantidad_Stock < $producto->Cantidad_Minima) {
                $notificaciones[] = "El producto '{$producto->Nombre_Producto}' está por debajo de la cantidad mínima.";
            }

            if ($producto->Cantidad_Stock > $producto->Cantidad_Maxima) {
                $notificaciones[] = "El producto '{$producto->Nombre_Producto}' ha superado la cantidad máxima.";
            }
        }

        return response()->json($notificaciones);
    }
}

