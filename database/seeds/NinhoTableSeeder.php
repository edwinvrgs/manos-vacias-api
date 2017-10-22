<?php

use Illuminate\Database\Seeder;
use App\Ninho;

class NinhoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ninho::class)->times(6)->create();
    }
}
