<?php  

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  

class MigratedCity extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('city', function (Blueprint $table) {  
            $table->id();  
            $table->string('name'); // 'nombre' cambiado a 'name'  
            $table->foreignId('country_id')->constrained('country'); // 'pais_id' cambiado a 'country_id'  
            $table->timestamps();  
        });  
    }  

    /**  
     * Reverse the migrations.  
     *  
     * @return void  
     */  
    public function down()  
    {  
        Schema::dropIfExists('city');  
    }  
}