<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'Usuario')->first();
        $role_admin = Role::where('name', 'Administrador')->first();
        $role_tech = Role::where('name', 'Tecnico')->first();
        $role_superv = Role::where('name', 'Supervisor')->first();

        $user = new User();
        $user->urlavatar = '2.png';
        $user->name = 'Usuario';
        $user->telephone = '12345678';
        $user->address = 'C/cualquiera';
        $user->birth = "1111-11-11";
        $user->email = 'usuario@ms.com';
        $user->password = bcrypt('secretoms');
        $user->save();
        $user->roles()->attach($role_user);  //Asignamos rol de usuario

        $user = new User();
        $user->urlavatar = '1.jpg';
        $user->name = 'Administrador';
        $user->telephone = '12345678';
        $user->address = 'C/cualquiera';
        $user->birth = "1111-11-11";
        $user->email = 'administrador@ms.com';
        $user->password = bcrypt('secretoms');
        $user->save();
        $user->roles()->attach($role_admin);  //Asignamos rol de administrador

        $user = new User();
        $user->urlavatar = '2.png';
        $user->name = 'Tecnico';
        $user->telephone = '12345678';
        $user->address = 'C/cualquiera';
        $user->birth = "1111-11-11";
        $user->email = 'tecnico@ms.com';
        $user->password = bcrypt('secretoms');
        $user->save();
        $user->roles()->attach($role_tech);  //Asignamos rol de tecnico

        $user = new User();
        $user->urlavatar = 'default.png';
        $user->name = 'Supervisor';
        $user->telephone = '12345678';
        $user->address = 'C/cualquiera';
        $user->birth = "1111-11-11";
        $user->email = 'supervisor@ms.com';
        $user->password = bcrypt('secretoms');
        $user->save();
        $user->roles()->attach($role_superv);  //Asignamos rol de tecnico
    
        }
}
