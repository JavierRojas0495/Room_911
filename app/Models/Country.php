<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Validation\Rule;  

class Country extends Model  
{  
    use HasFactory;  

    protected $table = 'country'; // Especifica el nombre de la tabla
    protected $fillable = ['name'];  

    public static function rules()  
    {  
        return [  
            'name' => 'required|string|max:255',  
        ];  
    }  
}