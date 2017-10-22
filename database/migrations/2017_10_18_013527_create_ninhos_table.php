<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNinhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ninho', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 20);
            $table->string('apellido', 20);
            $table->string('descripcion_situacion', 80);
            $table->timestamps();

            $table->integer('representante_cedula')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ninho');
    }
}
