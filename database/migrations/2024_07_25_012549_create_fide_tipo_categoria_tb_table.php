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
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 40);
            $table->string('last_update_by', 100)->nullable();
            $table->date('las_update_date')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_estado');

            $table->primary('id_tipo_categoria');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_tipo_categoria_tb');
    }
};
