<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fide_gastos_tb', function (Blueprint $table) {
            $table->bigIncrements('id_gasto');
            $table->string('monto_gasto', 2500);
            $table->string('descripcion_gasto', 200);
            $table->date('fecha_gasto');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('creado_por', 40);
            $table->string('modificado_por', 100)->nullable();
            $table->date('fecha_modificacion')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_transaccion');
            $table->unsignedBigInteger('id_estado');

            $table->primary('id_gasto');
            $table->foreign('id_usuario')->references('id_usuario')->on('fide_usuarios_tb');
            $table->foreign('id_transaccion')->references('id_transaccion')->on('fide_categoria_transaccion_tb');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_gastos_tb');
    }
};
