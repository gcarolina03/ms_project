<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;   

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Administrador';
        $role->description = 'Podrá gestionar completamente las incidencias y los usuarios y roles existentes en el sistema.';
        $role->save();

        $role = new Role();
        $role->name = 'Usuario';
        $role->description = 'Podrá registrar nuevas incidencias';
        $role->save();

        $role = new Role();
        $role->name = 'Tecnico';
        $role->description = 'Clasificará las incidencias y realizará un diagnóstico, y una resolución cerrando así la incidencia.';
        $role->save();

        $role = new Role();
        $role->name = 'Supervisor';
        $role->description = 'Podrá gestionar completamente las incidencias.';
        $role->save();

    }
}
