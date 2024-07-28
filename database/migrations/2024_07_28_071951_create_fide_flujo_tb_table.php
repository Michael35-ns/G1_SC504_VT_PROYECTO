<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFideFlujoTbTable extends Migration
{
    public function up()
    {
        Schema::create('fide_flujo_tb', function (Blueprint $table) {
            $table->id('id_flujo');
            $table->string('tipo_estado', 50);
            $table->string('nombre_estado', 100);
            $table->string('created_by', 100);
            $table->timestamp('creation_date')->useCurrent();
            $table->string('last_update_by', 100)->nullable();
            $table->timestamp('last_update_date')->useCurrent()->nullable();
            $table->string('accion', 100)->nullable();
            $table->unsignedBigInteger('id_estado');

            $table->primary('id_flujo');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_flujo_tb');
    }
}


