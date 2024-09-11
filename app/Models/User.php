<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extiende de Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // Extiende de Authenticatable
{
    use HasFactory, Notifiable;

    // Define la tabla asociada al modelo
    protected $table = 'user';

    // Los atributos que son asignables en masa
    protected $fillable = [
        'first_name',
        'last_name',
        'document_number',
        'password',
        'email',
        'is_active',
    ];

    // Los atributos que deberían ser ocultados para los arrays
    protected $hidden = [
        'password',
    ];

    // Los atributos que deben ser casteados a tipos nativos
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
