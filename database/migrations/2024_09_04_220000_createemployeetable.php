<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // 'nombre' cambiado a 'first_name'
            $table->string('last_name'); // 'apellido' cambiado a 'last_name'
            $table->string('document_number')->unique(); // 'num_documento' cambiado a 'document_number'
            $table->string('phone_number'); // 'num_telefono' cambiado a 'phone_number'
            $table->foreignId('country_id')->constrained('country'); // 'pais_id' cambiado a 'country_id'
            $table->foreignId('city_id')->constrained('city'); // 'ciudad_id' se mantiene
            $table->foreignId('departament_id')->constrained('departament'); // Clave foránea a 'departments'
            $table->date('birthdate'); // 'fecha_nacimiento' como 'birthdate'
            $table->string('address'); // 'direccion' como 'address'
            $table->string('email')->unique(); // Añadido 'email'
            $table->boolean('is_active')->default(true); // Campo de estado, 'is_active' para controlar si puede loguearse
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
        Schema::dropIfExists('employee');
    }
}
