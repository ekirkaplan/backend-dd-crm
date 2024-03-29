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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chief_director_id')->references('id')->on('chief_directors');
            $table->foreignId('region_director_id')->references('id')->on('region_directors');
            $table->foreignId('chiefdom_id')->references('id')->on('chiefdoms');
            $table->foreignId('product_type_id')->references('id')->on('product_types');
            $table->unsignedTinyInteger('archived')->default(0);
            $table->string('stack_no');
            $table->string('parcel_no');
            $table->double('cubic_meter');
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->double('forward_sale_price');
            $table->double('campaign_sale_price');
            $table->double('contract_stamp_duty');
            $table->double('forward_invoice_fee');
            $table->date('contract_invoice_date');
            $table->double('contract_invoice_price');
            $table->string('contract_receipt_no')->nullable();
            $table->date('field_pickup_date');
            $table->date('actual_start_date');
            $table->unsignedInteger('number_of_man_day');
            $table->unsignedInteger('extension_time_received')->nullable();
            $table->unsignedInteger('yield_percentage')->nullable();
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
        Schema::dropIfExists('contracts');
    }
};
