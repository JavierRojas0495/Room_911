<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'city';

    protected $fillable = ['name', 'country_id'];

    public static function reglas()
    {
        return [
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:country,id',
        ];
    }

    // Accesor para compatibilidad en las vistas
    public function getNombreAttribute() {
        return $this->name;
    }
}
