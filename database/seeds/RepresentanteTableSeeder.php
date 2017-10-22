<?php

use Illuminate\Database\Seeder;
use App\Representante;

class RepresentanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Representante::class)->times(6)->create();
    }
}
