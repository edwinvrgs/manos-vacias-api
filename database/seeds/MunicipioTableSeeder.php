<?php

use Illuminate\Database\Seeder;
use App\Estado;
use App\Municipio;

class MunicipioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipio')->delete();

        $estados = Estado::all();

        foreach(range(1, 50) as $index) {
            factory(Municipio::class)->create(['estado_id' => $estados->random()->id ]);
        }
    }
}
