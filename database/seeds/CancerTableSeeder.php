<?php

use Illuminate\Database\Seeder;
use App\Cancer;

class CancerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('cancer')->delete();
        factory(Cancer::class)->times(50)->create();
    }
}
