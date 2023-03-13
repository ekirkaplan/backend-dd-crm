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
        Schema::create('contract_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->references('id')->on('contracts');
            $table->foreignId('squad_id')->references('id')->on('squads');
            $table->foreignId('exit_product_type_id')->references('id')->on('product_types');
            $table->foreignId('shipment_id')->references('id')->on('shipments');
            $table->foreignId('exit_city_id')->references('id')->on('cities');
            $table->foreignId('arrival_location_id')->references('id')->on('arrival_locations');
            $table->foreignId('exit_user_id')->references('id')->on('users');
            $table->string('exit_licence_no');
            $table->string('exit_cubic_meter');
            $table->date('exit_date');
            $table->date('arrival_date');
            $table->unsignedBigInteger('arrival_tonnage');
            $table->double('arrival_calc_amount');
            $table->double('squad_calc_amount');
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
        Schema::dropIfExists('contract_shipments');
    }
};
