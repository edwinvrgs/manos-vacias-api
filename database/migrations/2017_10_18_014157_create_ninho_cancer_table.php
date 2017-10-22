<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNinhoCancerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ninho_cancer', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('ninho_id')->unsigned();
            $table->integer('cancer_id')->unsigned();
            /*$table->foreign('ninho_id')->references('id')->on('ninho')->onDelete('cascade');
            $table->foreign('cancer_id')->references('id')->on('cancer')->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ninho_cancer');
    }
}
