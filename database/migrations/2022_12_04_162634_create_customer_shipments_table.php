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
        Schema::create('customer_shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_type_id')->references('id')->on('product_types');
            $table->foreignId('exit_city_id')->references('id')->on('cities');
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('shipment_id')->references('id')->on('shipments');
            $table->foreignId('exit_company_id')->references('id')->on('companies');
            $table->morphs('exit_model');
            $table->string('supplier_purchase_invoice_no');
            $table->date('supplier_purchase_invoice_date');
            $table->double('supplier_purchase_invoice_amount');
            $table->date('shipment_date');
            $table->double('shipment_invoice_amount');
            $table->double('exit_tonnage');
            $table->unsignedTinyInteger('different_shipping_amount_status');
            $table->double('arrival_tonnage');
            $table->unsignedTinyInteger('different_tonnage_status');
            $table->string('product_invoice_no');
            $table->date('product_invoice_date');
            $table->string('product_invoice_amount_without_tax');
            $table->string('product_tax_percentage');
            $table->string('product_total_tax');
            $table->double('product_invoice_total_amount');
            $table->text('withholding');
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
        Schema::dropIfExists('customer_shipments');
    }
};
