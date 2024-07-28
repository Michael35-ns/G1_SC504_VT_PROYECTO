<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fide_categoria_transaccion_tb', function (Blueprint $table) {
            $table->bigIncrements('id_transaccion');
            $table->string('tipo_transaccion', 60);
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 40);
            $table->string('last_update_by', 100)->nullable();
            $table->date('las_update_date')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_tipo_categoria');
            $table->unsignedBigInteger('id_estado');

            $table->primary('id_transaccion');
            $table->foreign('id_usuario')->references('id_usuario')->on('fide_usuarios_tb');
            $table->foreign('id_tipo_categoria')->references('id_tipo_categoria')->on('fide_tipo_categoria_tb');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_categoria_transaccion_tb');
    }
};
