<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fide_objetivos_financieros_tb', function (Blueprint $table) {
            $table->bigIncrements('id_objetivo');
            $table->string('nombre_objetivo', 40);
            $table->string('descripcion_objetivo', 100);
            $table->decimal('monto_objetivo', 10, 2);
            $table->date('fecha_tope');
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 40);
            $table->string('last_update_by', 100)->nullable();
            $table->date('las_update_date')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_gastos')->nullable();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_flujo');
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_transaccion');
            $table->unsignedBigInteger('id_ingreso')->nullable();
            $table->unsignedBigInteger('id_presupuesto');

            $table->primary('id_objetivo');
            $table->foreign('id_gastos')->references('id_gasto')->on('fide_gastos_tb');
            $table->foreign('id_transaccion')->references('id_transaccion')->on('fide_categoria_transaccion_tb');
            $table->foreign('id_usuario')->references('id_usuario')->on('fide_usuarios_tb');
            $table->foreign('id_flujo')->references('id_flujo')->on('fide_flujo_tb');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
            $table->foreign('id_ingreso')->references('id_ingreso')->on('fide_ingresos_tb');
            $table->foreign('id_presupuesto')->references('id_presupuesto')->on('fide_presupuesto_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_objetivos_financieros_tb');
    }
};

