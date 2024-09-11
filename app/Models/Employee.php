<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
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

    // Definir relaciones, si existen
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class, 'departament_id');
    }

    public function loginLogs()
    {
        return $this->hasMany(LoginLog::class, 'employee_id', 'id');
    }

}
