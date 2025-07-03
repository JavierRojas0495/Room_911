<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'first_name',
        'last_name',
        'document_number',
        'phone_number',
        'country_id',
        'city_id',
        'departament_id',
        'birthdate',
        'address',
        'email',
        'is_active',
    ];

    // Relación con país
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'country_id');
    }

    // Relación con ciudad
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'city_id');
    }

    // Relación con departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departament_id');
    }

    // Relación con registros de inicio de sesión
    public function registrosInicioSesion()
    {
        return $this->hasMany(RegistroInicioSesion::class, 'employee_id', 'id');
    }

    // Accesores para compatibilidad con vistas en español
    public function getNombreAttribute() {
        return $this->first_name;
    }
    public function getApellidoAttribute() {
        return $this->last_name;
    }
    public function getNumeroDocumentoAttribute() {
        return $this->document_number;
    }
    public function getTelefonoAttribute() {
        return $this->phone_number;
    }
    public function getCorreoAttribute() {
        return $this->email;
    }
    public function getDepartamentoIdAttribute() {
        return $this->departament_id;
    }
    public function getPaisIdAttribute() {
        return $this->country_id;
    }
    public function getCiudadIdAttribute() {
        return $this->city_id;
    }
    public function getFechaNacimientoAttribute() {
        return $this->birthdate;
    }
    public function getDireccionAttribute() {
        return $this->address;
    }
}
