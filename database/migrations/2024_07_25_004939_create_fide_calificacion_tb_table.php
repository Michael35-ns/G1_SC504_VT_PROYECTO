<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFideCalificacionTbTable extends Migration
{
    public function up()
    {
        Schema::create('fide_calificacion_tb', function (Blueprint $table) {
            $table->bigIncrements('id_calificacion');
            $table->integer('estrellas');
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 100);
            $table->string('last_update_by', 100)->nullable();
            $table->timestamp('las_updated_date')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_estado');

            $table->primary('id_calificacion');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_calificacion_tb');
    }
}

