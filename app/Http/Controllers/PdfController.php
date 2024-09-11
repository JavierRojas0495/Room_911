<?php

namespace App\Http\Controllers;  

use Dompdf\Dompdf;  
use Dompdf\Options;  
use Illuminate\Http\Request;  
use App\Models\LoginLog; // Asegúrate de que este modelo esté bien configurado  
use App\Models\Employee; // Asegúrate de que este modelo esté bien configurado  

class PdfController extends Controller  
{  
    public function generatePdf(Request $request, $employeeId)  
    {  
        // Obtener el empleado  
        $employee = Employee::find($employeeId);  
        if (!$employee) {  
            return abort(404, 'Employee not found');  
        }  

        // Obtener registros de login según los parámetros  
        $logs = LoginLog::where('employee_id', $employeeId)  
            ->where('user_type', 'employee');  

        if ($request->start_date && $request->end_date) {  
            $logs->whereBetween('attempt_on_date', [$request->start_date, $request->end_date]);  
        }  

        $logs = $logs->get();  

        // Configuración de DomPDF  
        $options = new Options();  
        $options->set('defaultFont', 'Arial');  
        $dompdf = new Dompdf($options);  

        // Cargar vista  
        $html = view('employee.pdf_history', [  
            'logs' => $logs,  
            'employee' => $employee // Pasar el empleado a la vista  
        ])->render();  

        // Cargar el contenido HTML  
        $dompdf->loadHtml($html);  

        // (Opcional) Configurar tamaño y orientación  
        $dompdf->setPaper('A4', 'landscape');  

        // Renderizar el PDF  
        $dompdf->render();  

        // Descargar el PDF  
        return $dompdf->stream("access_history_employee_{$employeeId}.pdf");  
    }  
}