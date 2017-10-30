<?php

use Illuminate\Database\Seeder;
use App\Requerimiento;
use App\Ninho;
use App\Tipo;

class RequerimientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requerimiento')->delete();

        $tipos = Tipo::all();
        $ninhos = Ninho::all();

        foreach(range(1, 30) as $index) {

            factory(Requerimiento::class)->create([
                'tipo_id' => $tipos->random()->id,
                'ninho_id' => $ninhos->random()->id
            ]);
        }
    }
}
