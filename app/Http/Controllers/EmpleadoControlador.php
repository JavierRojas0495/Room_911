<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Empleado;
use App\Models\Departamento;
use App\Models\RegistroInicioSesion;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facades\Pdf;

class EmpleadoControlador extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indice(Request $solicitud)
    {
        $empleado_id = $solicitud->input('empleado_id');
        $departamento_id = $solicitud->input('departamento');
        $nombre = $solicitud->input('nombre');
        $apellido = $solicitud->input('apellido');
        $estado = $solicitud->input('estado');

        $consulta = Empleado::with('departamento')
            ->withCount([
                'registrosInicioSesion as registros_inicio_sesion_count' => function ($query) {
                    $query->where('user_type', 'empleado');
                }
            ]);

        if ($empleado_id) {
            $consulta->where('id', $empleado_id);
        }

        if ($departamento_id) {
            $consulta->where('departament_id', $departamento_id);
        }

        if ($nombre) {
            $consulta->where('first_name', 'like', '%' . $nombre . '%');
        }

        if ($apellido) {
            $consulta->where('last_name', 'like', '%' . $apellido . '%');
        }

        if ($estado === 'true') {
            $consulta->where('is_active', true);
        } elseif ($estado === 'false') {
            $consulta->where('is_active', false);
        }

        $empleados = $consulta->paginate(10); // Uso de paginación
        $departamentos = Departamento::all();

        return view('employee.index', compact('empleados', 'departamentos'));
    }

    public function crear()
    {
        $paises = Pais::all();
        $departamentos = Departamento::all();
        return view('employee.create', compact('paises', 'departamentos'));
    }

    public function obtenerCiudades($paisId)
    {
        $ciudades = Ciudad::where('country_id', $paisId)->get();

        $opciones = '<option value="" selected disabled>Selecciona Ciudad</option>';
        foreach ($ciudades as $ciudad) {
            $opciones .= '<option value="' . $ciudad->id . '">' . $ciudad->nombre . '</option>';
        }

        return $opciones;
    }

    public function guardar(Request $solicitud)
    {
        $departamentoId = $solicitud->input('departamento_id');
        $reglas = $this->obtenerReglasValidacion($solicitud, $departamentoId);
        $solicitud->validate($reglas);

        Empleado::create([
            'first_name' => $solicitud->input('nombre'),
            'last_name' => $solicitud->input('apellido'),
            'departament_id' => $solicitud->input('departamento_id'),
            'document_number' => $solicitud->input('numero_documento'),
            'phone_number' => $solicitud->input('telefono'),
            'city_id' => $solicitud->input('ciudad_id'),
            'country_id' => $solicitud->input('pais_id'),
            'birthdate' => $solicitud->input('fecha_nacimiento'),
            'address' => $solicitud->input('direccion'),
            'email' => $solicitud->input('correo'),
            'is_active' => true // Establece el estado en activo por defecto
        ]);

        return redirect()->route('empleado.indice')->with('success', 'Empleado creado exitosamente.');
    }

    public function editar(Empleado $empleado)
    {
        $paises = Pais::all();
        $departamentos = Departamento::all();
        $ciudades = Ciudad::where('country_id', $empleado->pais_id)->get();
        return view('employee.edit', compact('empleado', 'paises', 'departamentos', 'ciudades'));
    }

    public function actualizar(Request $solicitud, Empleado $empleado)
    {
        $departamentoId = $solicitud->input('departamento_id');
        $reglas = $this->obtenerReglasValidacion($solicitud, $departamentoId, $empleado->id);
        $solicitud->validate($reglas);

        $empleado->update([
            'first_name' => $solicitud->input('nombre'),
            'last_name' => $solicitud->input('apellido'),
            'departament_id' => $solicitud->input('departamento_id'),
            'document_number' => $solicitud->input('numero_documento'),
            'phone_number' => $solicitud->input('telefono'),
            'city_id' => $solicitud->input('ciudad_id'),
            'country_id' => $solicitud->input('pais_id'),
            'birthdate' => $solicitud->input('fecha_nacimiento'),
            'address' => $solicitud->input('direccion'),
            'email' => $solicitud->input('correo'),
        ]);

        return redirect()->route('empleado.indice')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function eliminar(Empleado $empleado)
    {
        $empleado->is_active = false;
        $empleado->save();
        return redirect()->route('empleado.indice')->with('success', 'Empleado eliminado exitosamente.');
    }

    private function obtenerReglasValidacion(Request $solicitud, $departamentoId, $empleadoId = null)
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'departamento_id' => 'required|exists:departament,id',
            'numero_documento' => [
                'required',
                'string',
                'max:15',
                Rule::unique('employee', 'document_number')->ignore($empleadoId)
            ],
            'telefono' => 'required|string|max:255',
            'pais_id' => 'required|exists:country,id',
            'ciudad_id' => 'required|exists:city,id',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string|max:255',
            'correo' => [
                'required',
                'email',
                Rule::unique('employee', 'email')->ignore($empleadoId)
            ],
        ];
    }

    public function alternarEstado(Empleado $empleado)
    {
        // Cambiar el estado 'is_active' del empleado
        $empleado->is_active = !$empleado->is_active;
        $empleado->save();

        // Mensaje de éxito
        $mensaje = $empleado->is_active ? 'Empleado habilitado exitosamente.' : 'Empleado deshabilitado exitosamente.';

        return redirect()->route('empleado.indice')->with('success', $mensaje);
    }

    public function importar(Request $solicitud)
    {
        // Validar el archivo CSV
        $solicitud->validate([
            'archivo_csv' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        try {
            // Procesar el archivo CSV
            $archivo = $solicitud->file('archivo_csv');
            $contenido = file_get_contents($archivo->getRealPath());
            $lineas = explode(PHP_EOL, $contenido);

            $encabezado = str_getcsv(array_shift($lineas)); // Obtener y eliminar el encabezado

            $importacionesFallidas = []; // Para guardar registros fallidos

            foreach ($lineas as $linea) {
                if (!empty($linea)) {
                    $fila = str_getcsv($linea);

                    // Asignar correctamente los IDs basados en tu CSV
                    $pais_id = isset($fila[4]) && is_numeric($fila[4]) ? (int)$fila[4] : null;
                    $ciudad_id = isset($fila[5]) && is_numeric($fila[5]) ? (int)$fila[5] : null;
                    $departamento_id = isset($fila[6]) && is_numeric($fila[6]) ? (int)$fila[6] : null;

                    // Validar que los IDs existan en las tablas correspondientes
                    $ciudadValida = $ciudad_id && Ciudad::find($ciudad_id);
                    $paisValido = $pais_id && Pais::find($pais_id);
                    $departamentoValido = $departamento_id && Departamento::find($departamento_id);

                    if ($ciudadValida && $paisValido && $departamentoValido) {
                        // Solo guardar si ciudad_id, pais_id y departamento_id son válidos
                        Empleado::updateOrCreate(
                            ['numero_documento' => $fila[2]], // Buscar por numero_documento
                            [
                                'nombre' => $fila[0],
                                'apellido' => $fila[1],
                                'telefono' => $fila[3],
                                'ciudad_id' => $ciudad_id,
                                'pais_id' => $pais_id,
                                'fecha_nacimiento' => $fila[7],
                                'direccion' => $fila[8],
                                'correo' => $fila[9],
                                'departamento_id' => $departamento_id,
                                'esta_activo' => true, // Por defecto
                            ]
                        );
                    } else {
                        // Agregar detalles al array de fallos
                        $importacionesFallidas[] = [
                            'nombre' => $fila[0],
                            'apellido' => $fila[1],
                            'razon' => 'ID de ciudad, país o departamento inválido.'
                        ];
                    }
                }
            }

            // Mensaje de éxito, puedes incluir detalles de registros fallidos
            if (count($importacionesFallidas) > 0) {
                return redirect()->route('empleado.indice')->with('warning', 'Algunos empleados no se importaron por IDs inválidos.');
            } else {
                return redirect()->route('empleado.indice')->with('success', 'Empleados importados exitosamente.');
            }

        } catch (\Exception $e) {
            // Manejar el error y redirigir con mensaje de error
            return redirect()->route('empleado.indice')->with('error', 'Ocurrió un error al importar el archivo: '.$e->getMessage());
        }
    }

    public function historial(Request $solicitud, $empleadoId)
    {
        // Debug: Log de la petición
        Log::info('Petición de historial', [
            'empleado_id' => $empleadoId,
            'is_ajax' => $solicitud->ajax(),
            'wants_json' => $solicitud->wantsJson(),
            'x_requested_with' => $solicitud->header('X-Requested-With'),
            'fecha_inicio' => $solicitud->fecha_inicio,
            'fecha_fin' => $solicitud->fecha_fin
        ]);

        $fecha_inicio = $solicitud->fecha_inicio;
        $fecha_fin = $solicitud->fecha_fin;

        // Validar que la fecha de inicio sea menor que la de fin si ambas están presentes
        if ($fecha_inicio && $fecha_fin && $fecha_inicio > $fecha_fin) {
            if ($solicitud->ajax()) {
                return response()->json([
                    'error' => 'La fecha de inicio no puede ser mayor que la fecha de fin'
                ], 400);
            }
            return redirect()->route('empleado.indice')->with('error', 'La fecha de inicio no puede ser mayor que la fecha de fin');
        }

        $registros = RegistroInicioSesion::where('employee_id', (string)$empleadoId)
            ->whereIn('user_type', ['employee', 'empleado', 'usuario']);

        // Aplicar filtros de fecha
        if ($fecha_inicio && $fecha_fin) {
            // Si ambas fechas están presentes, usar whereBetween
            $registros->whereBetween('attempt_on_date', [$fecha_inicio, $fecha_fin]);
        } elseif ($fecha_inicio) {
            // Si solo hay fecha de inicio, buscar desde esa fecha
            $registros->where('attempt_on_date', '>=', $fecha_inicio);
        } elseif ($fecha_fin) {
            // Si solo hay fecha de fin, buscar hasta esa fecha
            $registros->where('attempt_on_date', '<=', $fecha_fin);
        }

        $registros = $registros->orderBy('attempt_on_date', 'desc')
                               ->orderBy('attempt_in_time', 'desc')
                               ->get();

        // Detectar si es una petición AJAX
        if ($solicitud->ajax() || $solicitud->wantsJson() || $solicitud->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('employee.history_table', compact('registros', 'fecha_inicio', 'fecha_fin'))->render();
        }
        // Si no es AJAX, redirige a la lista de empleados
        return redirect()->route('empleado.indice');
    }

    public function generarPdf(Request $solicitud, $empleadoId)
    {
        // Obtener información del empleado
        $empleado = Empleado::findOrFail($empleadoId);

        // Obtener registros de inicio de sesión según los parámetros
        $registros = RegistroInicioSesion::where('employee_id', (string)$empleadoId)
            ->whereIn('user_type', ['employee', 'empleado', 'usuario']);

        if ($solicitud->fecha_inicio && $solicitud->fecha_fin) {
            $registros->whereBetween('attempt_on_date', [$solicitud->fecha_inicio, $solicitud->fecha_fin]);
        }

        $registros = $registros->orderBy('attempt_on_date', 'desc')
                               ->orderBy('attempt_in_time', 'desc')
                               ->get();

        // Generar el PDF
        $pdf = Pdf::loadView('employee.pdf_history', [
            'registros' => $registros,
            'empleado' => $empleado,
            'fecha_inicio' => $solicitud->fecha_inicio,
            'fecha_fin' => $solicitud->fecha_fin
        ]);

        // Descargar el PDF
        return $pdf->download("historial_empleado_{$empleado->first_name}_{$empleado->last_name}.pdf");
    }
}
