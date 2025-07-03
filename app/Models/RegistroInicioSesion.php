<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroInicioSesion extends Model
{
    use HasFactory;

    protected $table = 'login_logs';

    protected $fillable = [
        'employee_id',
        'user_type',
        'status',
        'attempt_on_date',
        'attempt_in_time',
    ];

    protected $casts = [
        'employee_id' => 'string',
        'attempt_on_date' => 'date',
        'attempt_in_time' => 'string',
    ];

    public $timestamps = true;

    // Relación con el empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'employee_id');
    }

    // Accesores para compatibilidad
    public function getIsSuccessfulAttribute()
    {
        return strpos($this->status, 'success') !== false;
    }

    public function getIpAddressAttribute()
    {
        return null; // No hay columna IP en la tabla actual
    }

    public function getUserAgentAttribute()
    {
        return null; // No hay columna user_agent en la tabla actual
    }

    public function getOperatingSystemAttribute()
    {
        return null; // No hay columna operating_system en la tabla actual
    }

    public function getFailureReasonAttribute()
    {
        return $this->is_successful ? null : $this->status;
    }
}
