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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_unidad_id');
            $table->integer('operaciones');
            $table->double('venta_efectivo')->default(0);
            $table->double('venta_credito')->default(0);
            $table->double('post')->default(0);
            $table->double('enzona')->default(0);
            $table->double('transfer_movil')->default(0);
            $table->double('tienda_virtual')->default(0);
            $table->integer('year');
            $table->enum('mes', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]);
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
        Schema::dropIfExists('registros');
    }
};