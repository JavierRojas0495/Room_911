<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // 'nombre'
            $table->string('last_name'); // 'apellido'
            $table->string('document_number')->unique(); // 'numero de documento'
            $table->string('password'); // 'contraseña'
            $table->string('email')->unique(); // 'correo electrónico'
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
        Schema::dropIfExists('user');
    }
}
