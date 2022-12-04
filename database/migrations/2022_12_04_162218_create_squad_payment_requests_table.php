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
        Schema::create('squad_payment_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('squad_id')->references('id')->on('squads');
            $table->foreignId('contract_id')->references('id')->on('contracts');
            $table->unsignedTinyInteger('status')->default(1);
            $table->date('payment_request_date');
            $table->double('request_amount');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('squad_payment_requests');
    }
};
