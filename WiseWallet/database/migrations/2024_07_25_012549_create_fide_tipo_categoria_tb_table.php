<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fide_tipo_categoria_tb', function (Blueprint $table) {
            $table->bigIncrements('id_tipo_categoria');
            $table->string('tipo_categoria', 60);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('creado_por', 40);
            $table->string('modificado_por', 100)->nullable();
            $table->date('fecha_modificacion')->nullable();
            $table->string('accion', 100);

            $table->primary('id_tipo_categoria');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_tipo_categoria_tb');
    }
};
