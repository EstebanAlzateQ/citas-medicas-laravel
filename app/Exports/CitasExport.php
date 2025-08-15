<?php

namespace App\Exports;

use App\Models\Cita;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;     
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;  


class CitasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $pacienteId;

    public function __construct(int $pacienteId)
    {
        $this->pacienteId = $pacienteId;
    }

    public function collection()
    {
        return Cita::where('paciente_id', $this->pacienteId)->with('medico')->get();
    }

    /**
     * Esta función es la que crea la fila de encabezados.
     */
    public function headings(): array
    {
        return [
            'ID Cita',
            'Fecha y Hora',
            'Nombre del Médico',
            'Especialidad Médico',
            'Motivo de la Consulta',
            'Estado',
        ];
    }

    public function map($cita): array
    {
        return [
            $cita->id,
            $cita->fecha_hora,
            $cita->medico->nombre_completo ?? 'N/A',
            $cita->medico->especialidad ?? 'N/A',
            $cita->motivo_consulta,
            $cita->estado,
        ];
    }
}
