<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFideEstadoTbTable extends Migration
{
    public function up()
    {
        Schema::create('fide_estado_tb', function (Blueprint $table) {
            $table->bigIncrements('id_estado');
            $table->string('tipo_estado', 50);
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 100);
            $table->string('last_updated_by', 100)->nullable();
            $table->timestamp('las_updated_date')->nullable();
            $table->string('accion', 100);

            $table->primary('id_estado');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_estado_tb');
    }
}

