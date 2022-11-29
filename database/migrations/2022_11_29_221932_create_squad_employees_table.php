<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('squad_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('squad_id')->references('id')->on('squads');
            $table->foreignId('employee_id')->references('id')->on('employees');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('squad_employees');
    }
};
