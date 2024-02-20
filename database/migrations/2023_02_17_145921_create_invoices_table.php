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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->enum('discount_type',['FIXED','PERCENTAGE'])->nullable();
            $table->double('discount_value')->nullable();
            $table->double('discount_amount')->default(0);
            $table->double('subtotal_amount')->default(0);
            $table->double('total_amount');
            $table->double('paid_amount');
            $table->double('remaining_amount');
            $table->enum('payment_status',['PAID','UNPAID'])
                  ->default('UNPAID');
            $table->unsignedBigInteger('doctor_id')->nullable(); 
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('doctor_id')->references('id')->on('doctors');
                // ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('order_id')->references('id')->on('orders');
                // ->onUpdate('cascade')->onDelete('set null');
            $table->string('notes')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
};
