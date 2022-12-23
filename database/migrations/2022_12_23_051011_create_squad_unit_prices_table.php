<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('squad_unit_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('squad_id')->references('id')->on('squads');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->double('price')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('squad_unit_prices');
    }
};
