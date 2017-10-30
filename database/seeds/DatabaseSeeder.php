<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            EstadoTableSeeder::class,
            MunicipioTableSeeder::class,
            RolTableSeeder::class,
            TipoTableSeeder::class,
            CancerTableSeeder::class,
            RepresentanteTableSeeder::class,
            UserTableSeeder::class,
            NinhoTableSeeder::class,
            RequerimientoTableSeeder::class,
            AdjuntoTableSeeder::class
        ]);

        Model::reguard();
    }
}
