<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepresentantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representante', function (Blueprint $table) {
            $table->integer('cedula')->unsigned()->primary();
            $table->string('nombre', 20);
            $table->string('apellido', 20);
            $table->string('numero_contacto_1', 15)->unique();
            $table->string('numero_contacto_2', 15)->nullable();
            $table->boolean('enable')->default(true);
            $table->timestamps();

            $table->integer('municipio_id')->unsigned();

            /*$table->foreign('municipio_id')->references('id')->on('municipio')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representante');
    }
}
