<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recordatorio de Cita</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; margin: 1cm; color: #333; }
        .header, .footer { position: fixed; left: 0; right: 0; width: 100%; text-align: center; border-bottom: 1px solid #eee; }
        .header { top: -1cm; padding-bottom: 5px; }
        .footer { bottom: -1cm; font-size: 0.8em; color: #777; border-top: 1px solid #eee; padding-top: 5px; }
        .content { margin-top: 2cm; margin-bottom: 2cm; }
        .info-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .info-table th, .info-table td { border: 1px solid #ddd; padding: 12px; text-align: left; font-size: 1.1em; }
        .info-table th { background-color: #f7f7f7; width: 30%; }
        h1 { color: #0056b3; text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="header"><h2>Clínica Bienestar</h2></div>
    <div class="footer"><p>Gracias por confiar en nosotros. Este es un documento generado automáticamente.</p></div>
    <div class="content">
        <h1>Recordatorio de Cita Médica</h1>
        <p>Estimado/a paciente, le recordamos los detalles de su próxima cita:</p>
        <table class="info-table">
            <tr>
                <th>Paciente</th>
                <td>{{ $cita->paciente->nombre_completo ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Médico</th>
                <td>{{ $cita->medico->nombre_completo ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Especialidad</th>
                <td>{{ $cita->medico->especialidad ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Fecha y Hora</th>
               <td>{{ \Carbon\Carbon::parse($cita->fecha_hora)->locale('es')->isoFormat('D [de] MMMM [de] YYYY, h:mm a') }}</td>
            </tr>
            <tr>
                <th>Motivo de la Consulta</th>
                <td>{{ $cita->motivo_consulta }}</td>
            </tr>
            <tr>
                <th>Estado de la Cita</th>
                <td style="font-weight: bold;">{{ $cita->estado }}</td>
            </tr>
        </table>
        <p style="margin-top: 30px;"><strong>Indicaciones importantes:</strong></p>
        <ul>
            <li>No olvide traer su documento de identidad.</li>
            <li>Si tiene exámenes médicos previos, por favor tráigalos.</li>
            <li>En caso de no poder asistir, por favor cancele la cita con al menos 24 horas de antelación.</li>
        </ul>
    </div>
</body>
</html>
