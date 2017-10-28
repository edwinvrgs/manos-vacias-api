<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->foreign('rol_id')->references('id')->on('rol')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('representante_cedula')->references('cedula')->on('representante')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('representante', function (Blueprint $table) {
            $table->foreign('municipio_id')->references('id')->on('municipio')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('ninho', function (Blueprint $table) {
            $table->foreign('representante_cedula')->references('cedula')->on('representante')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('requerimiento', function (Blueprint $table) {
            $table->foreign('tipo_id')->references('id')->on('tipo')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ninho_id')->references('id')->on('ninho')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('adjunto', function (Blueprint $table) {
            $table->foreign('requerimiento_id')->references('id')->on('requerimiento')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('municipio', function (Blueprint $table) {
            $table->foreign('estado_id')->references('id')->on('estado')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('ninho_cancer', function (Blueprint $table) {
            $table->foreign('ninho_id')->references('id')->on('ninho')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cancer_id')->references('id')->on('cancer')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropForeign(['rol_id']);
            $table->dropForeign(['representante_cedula']);
        });
        Schema::table('ninho', function (Blueprint $table) {
            $table->dropForeign(['representante_cedula']);
        });
        Schema::table('representante', function (Blueprint $table) {
            $table->dropForeign(['municipio_id']);
        });
        Schema::table('requerimiento', function (Blueprint $table) {
            $table->dropForeign(['tipo_id']);
            $table->dropForeign(['ninho_id']);
        });
        Schema::table('adjunto', function (Blueprint $table) {
            $table->dropForeign(['requerimiento_id']);
        });
        Schema::table('municipio', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);
        });
        Schema::table('ninho_cancer', function (Blueprint $table) {
            $table->dropForeign(['ninho_id']);
            $table->dropForeign(['cancer_id']);
        });
    }
}
