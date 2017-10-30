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
        DB::table('estado')->delete();
        $estados = factory(Estado::class)->times(10)->create();
    }
}
