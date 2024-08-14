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
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 100);
            $table->string('last_updated_by', 100)->nullable();
            $table->timestamp('las_updated_date')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_estado');

            
            $table->primary('id_presupuesto');
            $table->foreign('id_usuario')->references('id_usuario')->on('fide_usuarios_tb');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_presupuesto_tb');
    }
};

