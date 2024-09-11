<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;

    protected $table = 'departament'; // Especifica el nombre de la tabla

    protected $fillable = [
        'name', // Nombre del departamento
    ];

    // Puedes agregar relaciones con otros modelos si es necesario
    public function employees()
    {
        return $this->hasMany(Employee::class, 'departament_id');
    }
}
