<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    /**
     * Muestra las citas del paciente autenticado.
     */
    public function index()
    {
        $paciente = Auth::user();
        $citas = Cita::where('paciente_id', $paciente->id)->with('medico')->get();
        return response()->json($citas);
    }

    /**
     * Guarda una nueva cita.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'fecha_hora' => 'required|date',
            'motivo_consulta' => 'required|string',
        ]);

        $cita = Auth::user()->citas()->create([
            'medico_id' => $request->medico_id,
            'fecha_hora' => $request->fecha_hora,
            'motivo_consulta' => $request->motivo_consulta,
            'estado' => 'Programada',
        ]);

        return response()->json($cita, 201);
    }

    /**
     * Muestra una cita específica.
     */
    public function show(Cita $cita)
    {
        // Asegurarse de que el paciente solo vea sus propias citas
        if ($cita->paciente_id !== Auth::id()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }
        return response()->json($cita->load('medico'));
    }

    /**
     * Actualiza una cita específica.
     */
    public function update(Request $request, Cita $cita)
    {
        if ($cita->paciente_id !== Auth::id()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $request->validate([
            'medico_id' => 'sometimes|required|exists:medicos,id',
            'fecha_hora' => 'sometimes|required|date',
            'motivo_consulta' => 'sometimes|required|string',
            'estado' => 'sometimes|required|string|in:Programada,Cancelada,Completada',
        ]);

        $cita->update($request->all());

        return response()->json($cita);
    }

    /**
     * Elimina una cita específica.
     */
    public function destroy(Cita $cita)
    {
        if ($cita->paciente_id !== Auth::id()) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $cita->delete();

        return response()->json(['message' => 'Cita cancelada exitosamente'], 200);
    }
}
