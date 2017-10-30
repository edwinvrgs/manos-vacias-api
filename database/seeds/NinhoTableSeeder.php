<?php

use Illuminate\Database\Seeder;
use App\Ninho;
use App\Cancer;
use App\Representante;

class NinhoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ninho')->delete();

        $representantes = Representante::all();

        foreach(range(1, 20) as $index) {
            $canceres = Cancer::all();

            $ninho = factory(Ninho::class)->create([
                'representante_cedula' => $representantes->random()->cedula
            ]);

            $canceres->random()->ninhos()->attach($ninho);
            $canceres->random()->ninhos()->attach($ninho);
        }
    }
}
