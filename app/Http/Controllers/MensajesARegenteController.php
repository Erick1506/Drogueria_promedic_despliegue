<?php

namespace App\Http\Controllers;

use App\Models\MensajesARegente;
use Illuminate\Http\Request;

class MensajesARegenteController extends Controller
{
    public function index()
    {
        return response()->json(MensajesARegente::orderBy('fecha', 'desc')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mensaje' => 'required|string',
            'fecha' => 'nullable|date',
        ]);
        $mensaje = MensajesARegente::create($data);
        return response()->json($mensaje, 201);
    }

    public function show($id)
    {
        return response()->json(MensajesARegente::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $mensaje = MensajesARegente::findOrFail($id);
        $data = $request->validate([
            'mensaje' => 'required|string',
            'fecha' => 'nullable|date',
        ]);
        $mensaje->update($data);
        return response()->json($mensaje);
    }

    public function destroy($id)
    {
        $mensaje = MensajesARegente::findOrFail($id);
        $mensaje->delete();
        return response()->json(['status' => 'success', 'mensaje' => 'Notificación eliminada.']);
    }

    // Método extra para eliminar por texto del mensaje (opcional)
    public function destroyByMensaje(Request $request)
    {
        $mensajeText = $request->input('mensaje');
        if (!$mensajeText) {
            return response()->json(['status' => 'error', 'mensaje' => 'No se proporcionó el mensaje a eliminar.'], 400);
        }
        $deleted = MensajesARegente::where('mensaje', $mensajeText)->delete();
        if ($deleted) {
            return response()->json(['status' => 'success', 'mensaje' => 'Notificación eliminada.']);
        }
        return response()->json(['status' => 'error', 'mensaje' => 'Notificación no encontrada.'], 404);
    }
}
