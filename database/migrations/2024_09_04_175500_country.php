<?php  

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  

class Country extends Migration  
{  
    /**  
     * Run the migrations.  
     *  
     * @return void  
     */  
    public function up()  
    {  
        Schema::create('country', function (Blueprint $table) {  
            $table->id();  
            $table->string('name'); // 'nombre' cambiado a 'name'  
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
        Schema::dropIfExists('country');  
    }  
}