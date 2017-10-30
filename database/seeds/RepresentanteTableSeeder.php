<?php

use Illuminate\Database\Seeder;
use App\Representante;
use App\User;
use App\Municipio;

class RepresentanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('representante')->delete();

        $municipios = Municipio::all();

        foreach(range(1, 8) as $index) {
            factory(Representante::class)->create([
                'municipio_id' => $municipios->random()->id
            ]);
        }
    }
}
