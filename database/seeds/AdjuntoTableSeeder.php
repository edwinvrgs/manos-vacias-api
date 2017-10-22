<?php

use Illuminate\Database\Seeder;
use App\Adjunto;

class AdjuntoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Adjunto::class)->times(6)->create();
    }
}
