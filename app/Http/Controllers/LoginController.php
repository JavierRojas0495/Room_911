<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\LoginLog; // Importar el modelo LoginLog
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Importar la fachada Auth
use Carbon\Carbon; // Importar Carbon para manejar fechas y horas

class LoginController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showAdminLoginForm()
    {
        return view('login.login');
    }

    // Manejar la solicitud de inicio de sesión
    public function login(Request $request)
    {
        // Validar las credenciales
        $request->validate([
            'employee_id' => 'required',
            'password' => 'required',
        ]);

        // Buscar al usuario por employee_id
        $user = User::where('id', $request->employee_id)->first();

        if ($user) {
            // Verificar si el usuario está activo
            if (!$user->is_active) {
                // Registrar el intento fallido en el log por cuenta inactiva
                LoginLog::create([
                    'employee_id' => $request->employee_id,
                    'user_type' => 'user',
                    'status' => 'failed - account inactive',
                    'attempt_on_date' => Carbon::now()->format('Y-m-d'),  // Solo la fecha
                    'attempt_in_time' => Carbon::now()->format('H:i:s'),  // Solo la hora
                ]);

                return back()->with('error', 'Your account is inactive. Please contact support.');
            }

            // Verificar la contraseña
            if (Hash::check($request->password, $user->password)) {
                // Iniciar sesión
                Auth::login($user);

                // Registrar el intento exitoso en el log
                LoginLog::create([
                    'employee_id' => $request->employee_id,
                    'user_type' => 'user',
                    'status' => 'success',
                    'attempt_on_date' => Carbon::now()->format('Y-m-d'),  // Solo la fecha
                    'attempt_in_time' => Carbon::now()->format('H:i:s'),  // Solo la hora
                ]);

                return redirect()->route('employee.index')->with('success', 'Login successful');
            } else {
                // Registrar el intento fallido en el log
                LoginLog::create([
                    'employee_id' => $request->employee_id,
                    'user_type' => 'user',
                    'status' => 'failed - incorrect password',
                    'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                    'attempt_in_time' => Carbon::now()->format('H:i:s'),
                ]);

                return back()->with('error', 'Invalid credentials');
            }
        } else {
            // Registrar el intento fallido en el log
            LoginLog::create([
                'employee_id' => $request->employee_id,
                'user_type' => 'user',
                'status' => 'failed - user not found',
                'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                'attempt_in_time' => Carbon::now()->format('H:i:s'),
            ]);

            return back()->with('error', 'Invalid credentials');
        }
    }

    // Mostrar el formulario de login para empleados (sin contraseña)
    public function showEmployedLoginForm()
    {
        return view('login.authorized');
    }

    public function authorizeEmployee(Request $request)
    {
        $employee = Employee::find($request->employee_id);

        if ($employee) {
            // Verificar si el empleado está activo
            if (!$employee->is_active) {
                LoginLog::create([
                    'employee_id' => $request->employee_id,
                    'user_type' => 'employee',
                    'status' => 'failed - account inactive',
                    'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                    'attempt_in_time' => Carbon::now()->format('H:i:s'),
                ]);

                return back()->with('error', 'Your account is inactive.');
            }

            // Registrar el intento exitoso en el log
            LoginLog::create([
                'employee_id' => $request->employee_id,
                'user_type' => 'employee',
                'status' => 'success',
                'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                'attempt_in_time' => Carbon::now()->format('H:i:s'),
            ]);

            return redirect()->route('login.authorized')->with('success', 'Access granted');
        } else {
            LoginLog::create([
                'employee_id' => $request->employee_id,
                'user_type' => 'employee',
                'status' => 'failed - employee not found',
                'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                'attempt_in_time' => Carbon::now()->format('H:i:s'),
            ]);

            return back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()  
    {  
        Auth::logout(); // Cierra la sesión del usuario  
        return redirect('/')->with('success', 'The session has been closed successfully.'); // Redirigir a la página principal  
    }
}
