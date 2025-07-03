<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // Este middleware asegura que solo los usuarios autenticados accedan a este controlador
        $this->middleware('auth');
    }

    // Mostrar la lista de usuarios
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('filtro_id')) {
            $query->where('id', $request->input('filtro_id'));
        }
        if ($request->filled('filtro_nombre')) {
            $query->where('first_name', 'like', '%' . $request->input('filtro_nombre') . '%');
        }
        if ($request->filled('filtro_apellido')) {
            $query->where('last_name', 'like', '%' . $request->input('filtro_apellido') . '%');
        }
        if ($request->filled('filtro_documento')) {
            $query->where('document_number', 'like', '%' . $request->input('filtro_documento') . '%');
        }

        $users = $query->paginate(10);
        return view('user.index', compact('users'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('user.create');
    }

    // Almacenar un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_number' => 'required|string|unique:user',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|unique:user',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'document_number' => $request->document_number,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    // Mostrar el formulario de edición
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    // Actualizar un usuario existente
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_number' => 'required|string|unique:user,document_number,' . $user->id,
            'password' => 'nullable|string|min:8',
            'email' => 'required|string|email|unique:user,email,' . $user->id,
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'document_number' => $request->document_number,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'email' => $request->email,
        ]);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    // Eliminar un usuario
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
