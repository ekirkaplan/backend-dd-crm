<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments'  , function (Blueprint $table) {
            $table->id();
            $table->string('driver_name');
            $table->string('driver_phone');
            $table->string('vehicle_plate');
            $table->string('vehicle_brand')->nullable();
            $table->unsignedTinyInteger('vehicle_type')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
};
