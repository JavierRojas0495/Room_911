<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departament'; // Especifica el nombre de la tabla

    protected $fillable = [
        'name', // Nombre del departamento
    ];

    // Relación con empleados
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'departamento_id');
    }

    // Accesor para compatibilidad en las vistas
    public function getNombreAttribute() {
        return $this->name;
    }
}
