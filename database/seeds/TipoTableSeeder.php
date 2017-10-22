<?php

use Illuminate\Database\Seeder;
use App\Tipo;

class TipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tipo::class)->times(3)->create();
    }
}
