<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('squad_payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_transaction_type_id')->references('id')->on('payment_transaction_types');
            $table->foreignId('contact_id')->references('id')->on('contracts');
            $table->foreignId('squad_id')->references('id')->on('squads');
            $table->double('total_transaction_amount');
            $table->double('total_payment_amount');
            $table->date('payment_date');
            $table->double('payment_amount');
            $table->text('description');
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
        Schema::dropIfExists('squad_payment_transactions');
    }
};
