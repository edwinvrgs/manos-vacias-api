<?php

use Illuminate\Database\Seeder;
use App\Requerimiento;

class RequerimientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Requerimiento::class)->times(6)->create();
    }
}
