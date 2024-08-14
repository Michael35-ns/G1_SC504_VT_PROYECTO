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
            $table->timestamp('creation_date')->useCurrent();
            $table->string('created_by', 100);
            $table->string('last_updated_by', 100)->nullable();
            $table->timestamp('las_updated_date')->nullable();
            $table->string('accion', 100);
            $table->unsignedBigInteger('id_rol');
            $table->unsignedBigInteger('id_estado');

            
            $table->primary('id_usuario');
            $table->foreign('id_rol')->references('id_rol')->on('fide_rol_tb');
            $table->foreign('id_estado')->references('id_estado')->on('fide_estado_tb');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fide_usuarios_tb');
    }
};

