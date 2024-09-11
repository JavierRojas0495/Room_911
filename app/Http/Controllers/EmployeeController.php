<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\Employee;
use App\Models\Departament;
use App\Models\LoginLog;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $employee_id = $request->input('employee_id');
        $department_id = $request->input('department');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');

        $query = Employee::with('departament')
            ->withCount(['loginLogs' => function ($query) {
                $query->where('user_type', 'employee');
            }]);

        if ($employee_id) {
            $query->where('id', $employee_id);
        }

        if ($department_id) {
            $query->where('departament_id', $department_id);
        }

        if ($first_name) {
            $query->where('first_name', 'like', '%' . $first_name . '%');
        }

        if ($last_name) {
            $query->where('last_name', 'like', '%' . $last_name . '%');
        }
        $query->where('is_active', '!=','2');
        
        $employees = $query->paginate(10); // Uso de paginación

        $departments = Departament::all();

        return view('employee.index', compact('employees', 'departments'));
    }

    public function create()
    {
        $countries = Country::all();
        $departaments = Departament::all();
        return view('employee.create', compact('countries', 'departaments'));
    }

    public function getCities($countryId)
    {
        $cities = City::where('country_id', $countryId)->get();

        $options = '<option value="" selected disabled>Select City</option>';
        foreach ($cities as $city) {
            $options .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }

        return $options;
    }

    public function store(Request $request)
    {
        $departamentId = $request->input('departament_id');
        $rules = $this->getValidationRules($request, $departamentId);
        $request->validate($rules);

        Employee::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'departament_id' => $request->input('departament_id'),
            'document_number' => $request->input('document_number'),
            'phone_number' => $request->input('phone_number'),
            'city_id' => $request->input('city_id'),
            'country_id' => $request->input('country_id'),
            'birthdate' => $request->input('birthdate'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'is_active' => true // Establece el estado en activo por defecto
        ]);

        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }


    public function edit(Employee $employee)
    {
        $countries = Country::all();
        $departaments = Departament::all();
        return view('employee.edit', compact('employee', 'countries', 'departaments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $departamentId = $request->input('departament_id');
        $rules = $this->getValidationRules($request, $departamentId, $employee->id);
        $request->validate($rules);

        $employee->update($request->only([
            'first_name', 'last_name', 'departament_id', 'document_number', 
            'phone_number', 'city_id', 'country_id', 'birthdate', 'address', 
            'email'
        ]));

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->is_active = 2;
        $employee->save();
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }

    private function getValidationRules(Request $request, $departamentId, $employeeId = null)
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'departament_id' => 'required|exists:departament,id',
            'document_number' => [
                'required',
                'string',
                'max:15',
                Rule::unique('employee', 'document_number')->ignore($employeeId)
            ],
            'phone_number' => 'required|string|max:255',
            'country_id' => 'required|exists:country,id',
            'city_id' => 'required|exists:city,id',
            'birthdate' => 'required|date',
            'address' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('employee', 'email')->ignore($employeeId)
            ],
        ];
    }

    public function toggleStatus(Employee $employee)
    {
        // Cambiar el estado 'is_active' del empleado
        $employee->is_active = !$employee->is_active;
        $employee->save();

        // Mensaje de éxito
        $message = $employee->is_active ? 'Employee enabled successfully.' : 'Employee disabled successfully.';

        return redirect()->route('employee.index')->with('success', $message);
    }

    public function import(Request $request)  
    {  
        // Validar el archivo CSV  
        $request->validate([  
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',  
        ]);  

        try {  
            // Procesar el archivo CSV  
            $file = $request->file('csv_file');  
            $content = file_get_contents($file->getRealPath());  
            $lines = explode(PHP_EOL, $content);  

            $header = str_getcsv(array_shift($lines)); // Obtener y eliminar el encabezado  

            $failedImports = []; // Para guardar registros fallidos  

            foreach ($lines as $line) {  
                if (!empty($line)) {  
                    $row = str_getcsv($line);  
                    
                    // Asignar correctamente los IDs basados en tu CSV  
                    $country_id = isset($row[4]) && is_numeric($row[4]) ? (int)$row[4] : null;  
                    $city_id = isset($row[5]) && is_numeric($row[5]) ? (int)$row[5] : null;  
                    $departament_id = isset($row[6]) && is_numeric($row[6]) ? (int)$row[6] : null;  

                    // Validar que los IDs existan en las tablas correspondientes  
                    $validCity = $city_id && City::find($city_id);  
                    $validCountry = $country_id && Country::find($country_id);  
                    $validDepartament = $departament_id && Departament::find($departament_id);  

                    if ($validCity && $validCountry && $validDepartament) {  
                        // Solo guardar si city_id, country_id y departament_id son válidos  
                        Employee::updateOrCreate(  
                            ['document_number' => $row[2]], // Buscar por document_number  
                            [  
                                'first_name' => $row[0],  
                                'last_name' => $row[1],  
                                'phone_number' => $row[3],  
                                'city_id' => $city_id,  
                                'country_id' => $country_id,  
                                'birthdate' => $row[7],  
                                'address' => $row[8],  
                                'email' => $row[9],  
                                'departament_id' => $departament_id,  
                                'is_active' => true, // Por defecto  
                            ]  
                        );  
                    } else {  
                        // Agregar detalles al array de fallos  
                        $failedImports[] = [  
                            'first_name' => $row[0],  
                            'last_name' => $row[1],  
                            'reason' => 'Invalid city, country, or department ID.'  
                        ];  
                    }  
                }  
            }  

            // Mensaje de éxito, puedes incluir detalles de registros fallidos  
            if (count($failedImports) > 0) {  
                return redirect()->route('employee.index')->with('warning', 'Some employees were not imported due to invalid IDs.');  
            } else {  
                return redirect()->route('employee.index')->with('success', 'Employees imported successfully.');  
            }  

        } catch (\Exception $e) {  
            // Manejar el error y redirigir con mensaje de error  
            return redirect()->route('employee.index')->with('error', 'An error occurred while importing the file: '.$e->getMessage());  
        }
    }

    public function history(Request $request, $employeeId)
    {
        $logs = LoginLog::where('employee_id', $employeeId)
            ->where('user_type', 'employee');

        if ($request->start_date && $request->end_date) {
            $logs->whereBetween('attempt_on_date', [$request->start_date, $request->end_date]);
        }

        $logs = $logs->get();

        // Retornar una vista parcial con los logs
        return view('employee.history', compact('logs'))->render();
    }

    public function generatePdf(Request $request, $employeeId)  
    {  
        // Obtener registros de login según los parámetros  
        $logs = LoginLog::where('employee_id', $employeeId)  
            ->where('user_type', 'employee');  

        if ($request->start_date && $request->end_date) {  
            $logs->whereBetween('attempt_on_date', [$request->start_date, $request->end_date]);  
        }  

        $logs = $logs->get();  

        // Generar el PDF  
        $pdf = PDF::loadView('employee.pdf_history', ['logs' => $logs]);  

        // Descargar el PDF  
        return $pdf->download("history_employee_{$employeeId}.pdf");  
    }

}
