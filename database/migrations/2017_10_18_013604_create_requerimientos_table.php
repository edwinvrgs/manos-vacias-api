<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 45);
            $table->integer('cantidad');
            $table->date('fecha_vencimiento');
            $table->boolean('enable')->default(true);
            $table->timestamps();

            $table->integer('tipo_id')->unsigned();
            $table->integer('ninho_id')->unsigned();

            /*$table->foreign('tipo_id')->references('id')->on('tipo')->onDelete('cascade');
            $table->foreign('ninho_id')->references('id')->on('ninho')->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requerimiento');
    }
}
