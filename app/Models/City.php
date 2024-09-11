<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Validation\Rule;  

class City extends Model  
{  
    use HasFactory;  
    
    protected $table = 'City'; // Especifica el nombre de la tabla  

    protected $fillable = ['name', 'country_id'];

    public static function rules()  
    {  
        return [  
            'name' => 'required|string|max:255',  
            'country_id' => 'required|exists:countries,id',  
        ];  
    }  
}