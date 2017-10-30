<?php

use Illuminate\Database\Seeder;
use App\Adjunto;
use App\Requerimiento;

class AdjuntoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adjunto')->delete();

        $requerimientos = Requerimiento::all();

        foreach(range(1, 50) as $index) {
            factory(Adjunto::class)->create([
                'requerimiento_id' => $requerimientos->random()->id
            ]);
        }
    }
}
