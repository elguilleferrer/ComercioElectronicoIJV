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
        Schema::create('registro_efectivo_creditos', function (Blueprint $table) {
            $table->id();
            $table->double('venta_efectivo')->default(0);
            $table->double('venta_credito')->default(0);
            $table->integer('year');
            $table->enum('mes', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]);
            $table->text('comentario')->nullable();
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
        Schema::dropIfExists('registro_efectivo_creditos');
    }
};
