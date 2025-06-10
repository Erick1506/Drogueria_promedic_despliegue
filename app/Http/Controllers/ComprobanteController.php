<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ComprobanteController extends Controller
{
    // Lista todos los comprobantes existentes
    public function index()
    {
        return Comprobante::all();
    }

    // Registra un nuevo comprobante
    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_Regente' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('promedicch.regente')->where('Id_Regente', $value)->exists();
                    if (!$exists) {
                        $fail("El regente con ID {$value} no existe.");
                    }
                },
            ],
            'Id_Producto' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('promedicch.Producto')->where('Id_Producto', $value)->exists();
                },
            ],
            'Cantidad' => 'nullable|integer',
            'Fecha_Venta' => 'nullable|date',
            'Total' => 'nullable|integer',
        ]);

        $comprobante = Comprobante::create($data);

        return response()->json($comprobante, 201);
    }

    // Muestra el comprobante especificado por ID
    public function show($id)
    {
        return Comprobante::findOrFail($id);
    }

    // Actualiza un comprobante existente
    public function update(Request $request, $id)
    {
        $comprobante = Comprobante::findOrFail($id);

        $data = $request->validate([
            'Id_Regente' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('promedicch.regente')->where('Id_Regente', $value)->exists();
                    if (!$exists) {
                        $fail("El regente con ID {$value} no existe.");
                    }
                },
            ],
            'Id_Producto' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {
                    $exists = DB::table('promedicch.Producto')->where('Id_Producto', $value)->exists();
                },
            ],
            'Cantidad' => 'nullable|integer',
            'Fecha_Venta' => 'nullable|date',
            'Total' => 'nullable|integer',
        ]);

        $comprobante->update($data);

        return response()->json($comprobante);
    }

    // Elimina un comprobante por ID
    public function destroy($id)
    {
        Comprobante::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
