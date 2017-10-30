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
		DB::table('tipo')->delete();
        factory(Tipo::class)->times(3)->create();
    }
}
