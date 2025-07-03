<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'country'; // Especifica el nombre de la tabla
    protected $fillable = ['name'];

    public static function reglas()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    // Accesor para compatibilidad en las vistas
    public function getNombreAttribute() {
        return $this->name;
    }
}
