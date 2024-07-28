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
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 100);
            $table->string('last_update_by', 100)->nullable();
            $table->timestamp('las_update_date')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_estado');

            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');

            $table->primary('id_rol');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_rol_tb');
    }
}


