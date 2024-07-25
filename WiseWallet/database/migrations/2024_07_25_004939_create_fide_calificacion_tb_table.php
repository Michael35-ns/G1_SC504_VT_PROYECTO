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
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('creado_por', 40);
            $table->string('modificado_por', 100)->nullable();
            $table->timestamp('fecha_modificacion')->nullable();
            $table->string('accion', 100);

            $table->primary('id_calificacion');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_calificacion_tb');
    }
}
