<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fide_resennas_tb', function (Blueprint $table) {
            $table->bigIncrements('id_resenna');
            $table->string('detalle', 200);
            $table->string('descripcion', 800);
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 40);
            $table->string('last_update_by', 100)->nullable();
            $table->date('las_update_date')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_calificacion');
            $table->unsignedBigInteger('id_estado');

            $table->primary('id_resenna');
            $table->foreign('id_usuario')->references('id_usuario')->on('fide_usuarios_tb');
            $table->foreign('id_calificacion')->references('id_calificacion')->on('fide_calificacion_tb');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_resennas_tb');
    }
};
