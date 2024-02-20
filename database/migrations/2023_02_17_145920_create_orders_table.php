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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name')->nullable();
            $table->tinyInteger('delivered')->default(0)->comment('delivered to doctor or not');
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctors');
//                               ->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
//                ->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('tooth_type_id');
            $table->foreign('tooth_type_id')->references('id')->on('tooth_types');
//                ->onUpdate('cascade')->onDelete('set null');
            $table->string('attachment')->nullable();
//                ->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('orders');
    }
};
