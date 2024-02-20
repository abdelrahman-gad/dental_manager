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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('expense_type_id');
            $table->foreign('expense_type_id')->references('id')->on('expense_types');
//                ->onUpdate('cascade')->onDelete('set null');
            $table->double('cost');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * 
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
