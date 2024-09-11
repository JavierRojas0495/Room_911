<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginLogsTable extends Migration
{
    public function up()
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('user_type');
            $table->string('status');
            $table->date('attempt_on_date');  // Campo solo para la fecha
            $table->time('attempt_in_time');  // Campo solo para la hora
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('login_logs');
    }
}
