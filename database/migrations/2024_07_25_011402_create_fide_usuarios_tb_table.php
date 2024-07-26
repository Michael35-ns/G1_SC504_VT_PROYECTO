<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fide_usuarios_tb', function (Blueprint $table) {
            $table->bigIncrements('id_usuario');
            $table->string('nombre', 40);
            $table->string('primer_apellido', 50);
            $table->string('segundo_apellido', 50);
            $table->string('username', 30);
            $table->string('correo_electronico', 50);
            $table->string('contrasenna', 30);
            $table->string('foto_perfil_url', 3000)->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('creado_por', 40);
            $table->string('modificado_por', 100)->nullable();
            $table->date('fecha_modificacion')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_rol');

            $table->primary('id_usuario');
            $table->foreign('id_rol')->references('id_rol')->on('fide_rol_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_usuarios_tb');
    }
};
