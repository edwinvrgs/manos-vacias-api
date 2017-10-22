<?php

use Illuminate\Database\Seeder;
use App\Estado;
use App\Municipio;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = factory(Estado::class)->times(10)->create();

        foreach($estados as $estado) {

            $estado->municipios()->saveMany(factory(Municipio::class)->times(10)->create());
        }
    }
}
