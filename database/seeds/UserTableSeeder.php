<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Rol;
use App\Representante;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->delete();

        $roles = Rol::all();
        $representantes = Representante::all();

        foreach(range(1, 8) as $index) {
            factory(User::class)->create([
                'rol_id' => $roles->random()->id,
                'representante_cedula' => $representantes->pop()->cedula
            ]);
        }
    }
}
