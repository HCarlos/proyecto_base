<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
                RolesAndPermissionsSeeder::class,
                AddUsuariosAlumnosSeeder::class,
                AddUsuariosPersonasSeeder::class,
                AddUsuariosProfesoresSeeder::class,
                AddUsuariosExalumnosSeeder::class,
            ]);
    }
}
