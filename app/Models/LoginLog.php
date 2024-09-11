<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
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

    public $timestamps = true;
}
