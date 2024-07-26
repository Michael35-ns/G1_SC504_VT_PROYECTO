<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fide_presupuesto_desglose_tb', function (Blueprint $table) {
            $table->bigIncrements('id_presupuesto_desglose');
            $table->decimal('monto', 12, 2);
            $table->string('nombre', 40);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('creado_por', 40);
            $table->string('modificado_por', 100)->nullable();
            $table->date('fecha_modificacion')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_presupuesto');

            $table->primary('id_presupuesto_desglose');
            $table->foreign('id_presupuesto')->references('id_presupuesto')->on('fide_presupuesto_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_presupuesto_desglose_tb');
    }
};
