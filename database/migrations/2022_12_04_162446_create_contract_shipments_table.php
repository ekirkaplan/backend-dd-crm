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
            $table->foreignId('customer_id')->nullable()->references('id')->on('customers');
            $table->string('exit_licence_no')->nullable();
            $table->string('exit_cubic_meter');
            $table->date('exit_date');
            $table->date('arrival_date');
            $table->unsignedBigInteger('arrival_tonnage');
            $table->double('arrival_calc_amount');
            $table->double('squad_calc_amount');
            $table->string('shipment_invoice_no')->nullable();
            $table->unsignedInteger('shipment_tax_rate')->nullable();
            $table->date('shipment_invoice_date')->nullable();
            $table->double('shipment_invoice_without_amount')->nullable();
            $table->double('shipment_invoice_total_amount')->nullable();
            $table->unsignedInteger('shipment_invoice_withholding')->nullable();
            $table->string('invoice_no')->nullable();
            $table->unsignedInteger('tax_rate')->nullable();
            $table->date('invoice_date')->nullable();
            $table->double('invoice_without_amount')->nullable();
            $table->double('invoice_total_amount')->nullable();
            $table->unsignedInteger('invoice_withholding')->nullable();
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
