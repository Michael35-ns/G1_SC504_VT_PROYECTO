<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fide_presupuesto_tb', function (Blueprint $table) {
            $table->bigIncrements('id_presupuesto');
            $table->decimal('monto_total', 12, 2);
            $table->date('create_at');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('creado_por', 40);
            $table->string('modificado_por', 100)->nullable();
            $table->date('fecha_modificacion')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_usuario');

            $table->primary('id_presupuesto');
            $table->foreign('id_usuario')->references('id_usuario')->on('fide_usuarios_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_presupuesto_tb');
    }
};
