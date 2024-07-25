<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFideRolTbTable extends Migration
{
    public function up()
    {
        Schema::create('fide_rol_tb', function (Blueprint $table) {
            $table->bigIncrements('id_rol');
            $table->string('descripcion', 50);
            $table->string('nombre_rol', 50);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('creado_por', 40);
            $table->string('modificado_por', 100)->nullable();
            $table->timestamp('fecha_modificacion')->nullable();
            $table->string('accion', 100);

            $table->primary('id_rol');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_rol_tb');
    }
}

