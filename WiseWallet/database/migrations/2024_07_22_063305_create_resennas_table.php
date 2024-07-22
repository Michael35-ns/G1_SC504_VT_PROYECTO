<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResennasTable extends Migration
{
    public function up()
    {
        Schema::create('resennas', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            $table->text('descripcion');
            $table->date('fecha');
            $table->string('usuario_reg');
            $table->integer('calificacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('resennas');
    }
}
