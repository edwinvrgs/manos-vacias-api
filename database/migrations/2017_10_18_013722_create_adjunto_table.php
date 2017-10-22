<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdjuntoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjunto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion', 30);
            $table->string('imagen', 100)->nullable();
            $table->timestamps();

            $table->integer('requerimiento_id')->unsigned();

            //$table->foreign('requerimiento_id')->references('id')->on('requerimiento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adjunto');
    }
}
