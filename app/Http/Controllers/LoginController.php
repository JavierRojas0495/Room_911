<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
use App\Models\RegistroInicioSesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
                RegistroInicioSesion::create([
                    'employee_id' => $request->employee_id,
                    'user_type' => 'usuario',
                    'status' => 'fallido',
                    'failure_reason' => 'cuenta inactiva',
                    'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                    'attempt_in_time' => Carbon::now()->format('H:i:s'),
                ]);
                return back()->with('error', 'Tu cuenta está inactiva. Por favor contacta al soporte.');
            }
            // Verificar la contraseña
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                RegistroInicioSesion::create([
                    'employee_id' => $request->employee_id,
                    'user_type' => 'usuario',
                    'status' => 'exitoso',
                    'failure_reason' => null,
                    'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                    'attempt_in_time' => Carbon::now()->format('H:i:s'),
                ]);
                return redirect()->route('empleado.indice')->with('success', 'Inicio de sesión exitoso');
            } else {
                RegistroInicioSesion::create([
                    'employee_id' => $request->employee_id,
                    'user_type' => 'usuario',
                    'status' => 'fallido',
                    'failure_reason' => 'contraseña incorrecta',
                    'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                    'attempt_in_time' => Carbon::now()->format('H:i:s'),
                ]);
                return back()->with('error', 'Credenciales inválidas');
            }
        }
        RegistroInicioSesion::create([
            'employee_id' => $request->employee_id,
            'user_type' => 'usuario',
            'status' => 'fallido',
            'failure_reason' => 'usuario no encontrado',
            'attempt_on_date' => Carbon::now()->format('Y-m-d'),
            'attempt_in_time' => Carbon::now()->format('H:i:s'),
        ]);
        return back()->with('error', 'Credenciales inválidas');
    }

    // Mostrar el formulario de login para empleados (sin contraseña)
    public function showEmployedLoginForm()
    {
        return view('login.authorized');
    }

    public function authorizeEmployee(Request $request)
    {
        $empleado = Empleado::find($request->employee_id);
        if ($empleado) {
            if (!$empleado->is_active) {
                RegistroInicioSesion::create([
                    'employee_id' => $request->employee_id,
                    'user_type' => 'empleado',
                    'status' => 'fallido',
                    'failure_reason' => 'cuenta inactiva',
                    'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                    'attempt_in_time' => Carbon::now()->format('H:i:s'),
                ]);
                return back()->with('error', 'Tu cuenta está inactiva.');
            }
            RegistroInicioSesion::create([
                'employee_id' => $request->employee_id,
                'user_type' => 'empleado',
                'status' => 'exitoso',
                'failure_reason' => null,
                'attempt_on_date' => Carbon::now()->format('Y-m-d'),
                'attempt_in_time' => Carbon::now()->format('H:i:s'),
            ]);
            return redirect()->route('login.authorized')->with('success', 'Acceso concedido');
        }
        RegistroInicioSesion::create([
            'employee_id' => $request->employee_id,
            'user_type' => 'empleado',
            'status' => 'fallido',
            'failure_reason' => 'empleado no encontrado',
            'attempt_on_date' => Carbon::now()->format('Y-m-d'),
            'attempt_in_time' => Carbon::now()->format('H:i:s'),
        ]);
        return back()->with('error', 'Credenciales inválidas');
    }

    public function logout()
    {
        Auth::logout(); // Cierra la sesión del usuario
        return redirect('/')->with('success', 'La sesión se ha cerrado correctamente.'); // Redirigir a la página principal
    }
}
