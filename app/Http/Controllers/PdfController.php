<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\RegistroInicioSesion;
use App\Models\Empleado;

class PdfController extends Controller
{
    public function generatePdf(Request $request, $empleadoId)
    {
        // Obtener el empleado
        $empleado = Empleado::find($empleadoId);
        if (!$empleado) {
            return abort(404, 'Empleado no encontrado');
        }

        // Obtener registros de inicio de sesión según los parámetros
        $registros = RegistroInicioSesion::where('employee_id', (string)$empleadoId)
            ->whereIn('user_type', ['employee', 'empleado', 'usuario']);

        // Aplicar filtros de fecha
        if ($request->fecha_inicio && $request->fecha_fin) {
            $registros->whereBetween('attempt_on_date', [$request->fecha_inicio, $request->fecha_fin]);
        } elseif ($request->fecha_inicio) {
            $registros->where('attempt_on_date', '>=', $request->fecha_inicio);
        } elseif ($request->fecha_fin) {
            $registros->where('attempt_on_date', '<=', $request->fecha_fin);
        }

        $registros = $registros->orderBy('attempt_on_date', 'desc')
                               ->orderBy('attempt_in_time', 'desc')
                               ->get();

        // Configuración de DomPDF
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Cargar vista
        $html = view('employee.pdf_history', [
            'registros' => $registros,
            'empleado' => $empleado,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin
        ])->render();

        // Cargar el contenido HTML
        $dompdf->loadHtml($html);

        // (Opcional) Configurar tamaño y orientación
        $dompdf->setPaper('A4', 'landscape');

        // Renderizar el PDF
        $dompdf->render();

        // Descargar el PDF
        return $dompdf->stream("historial_accesos_empleado_{$empleadoId}.pdf");
    }
}
