<?php

use App\Http\Controllers\Funciones\FuncionesController;
use App\User;
use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $F = new FuncionesController();
        $ip   = 'root_init';//$_SERVER['REMOTE_ADDR'];
        $host = 'root_init';//gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $idemp = 1;

        $P0 = Permission::create(['name' => 'all']);
        $P1 = Permission::create(['name' => 'crear']);
        $P2 = Permission::create(['name' => 'guardar']);
        $P3 = Permission::create(['name' => 'editar']);
        $P4 = Permission::create(['name' => 'modificar']);
        $P5 = Permission::create(['name' => 'eliminar']);
        $P6 = Permission::create(['name' => 'consultar']);
        $P7 = Permission::create(['name' => 'imprimir']);
        $P8 = Permission::create(['name' => 'asignar']);
        $P9 = Permission::create(['name' => 'desasignar']);
        $P13 = Permission::create(['name' => 'sysop']);

        $role_admin = Role::create([
            'name' => 'Administrator',
            'description' => 'Administrator',
            'guard_name' => 'web',
        ]);
        $role_admin->givePermissionTo($P0);

        $role_sysop = Role::create([
            'name' => 'SysOp',
            'description' => 'System Operator',
            'guard_name' => 'web',
        ]);
        $role_sysop->givePermissionTo($P13);

        $role_alumno = Role::create([
            'name' => 'Alumno',
            'description' => 'Alumno',
            'guard_name' => 'web',
        ]);
        $role_alumno->givePermissionTo($P6);

        $role_profesor = Role::create([
            'name' => 'Profesor',
            'description' => 'Profesor',
            'guard_name' => 'web',
        ]);
        $role_profesor->givePermissionTo($P6);

        $role_director = Role::create([
            'name' => 'Director',
            'description' => 'Director',
            'guard_name' => 'web',
        ]);
        $role_director->givePermissionTo($P6);

        $role_coordinador = Role::create([
            'name' => 'Coordinador',
            'description' => 'Coordinador cuadernos',
            'guard_name' => 'web',
        ]);
        $role_coordinador->givePermissionTo($P6);

        $role_asesor = Role::create([
            'name' => 'Asesor',
            'description' => 'Asesor',
            'guard_name' => 'web',
        ]);
        $role_asesor->givePermissionTo($P6);

        $role_tutor = Role::create([
            'name' => 'Tutor',
            'description' => 'Tutor',
            'guard_name' => 'web',
        ]);
        $role_tutor->givePermissionTo($P6);

        $role_familiar = Role::create([
            'name' => 'Familiar',
            'description' => 'Familiar',
            'guard_name' => 'web',
        ]);
        $role_familiar->givePermissionTo($P6);

        $role_ce = Role::create([
            'name' => 'Control_Escolar',
            'description' => 'Control Escolar',
            'guard_name' => 'web',
        ]);
        $role_ce->givePermissionTo($P6);

        $role_caja = Role::create([
            'name' => 'Caja',
            'description' => 'Caja Escolar',
            'guard_name' => 'web',
        ]);
        $role_caja->givePermissionTo($P6);

        $role_da = Role::create([
            'name' => 'Director_Administrativo',
            'description' => 'Director Administrativo',
            'guard_name' => 'web',
        ]);
        $role_da->givePermissionTo($P6);

        $role_contador = Role::create([
            'name' => 'Contador@',
            'description' => 'Contador@',
            'guard_name' => 'web',
        ]);
        $role_contador->givePermissionTo($P6);


        $user = new User();
        $user->nombre = 'Administrador';
        $user->username = 'Admin';
        $user->email = 'admin@example.com';
        $user->cuenta = '20182404130814';
        $user->password = bcrypt('secret');
        $user->admin = true;
        $user->idemp = $idemp;
        $user->ip = $ip;
        $user->host = $host;
        $user->save();
        $user->roles()->attach($role_admin);
        $user->permissions()->attach($P0);
        $F->validImage($user,'profile','profile/');

        $user = new User();
        $user->nombre = 'System Operator';
        $user->username = 'SysOp';
        $user->email = 'sysop@example.com';
        $user->cuenta = '20181907130824';
        $user->password = bcrypt('sysop');
        $user->admin = false;
        $user->idemp = $idemp;
        $user->ip = $ip;
        $user->host = $host;
        $user->save();
        $user->roles()->attach($role_sysop);
        $user->permissions()->attach($P13);
        $F->validImage($user,'profile','profile/');

        $user = new User();
        $user->ap_paterno = 'Profesor';
        $user->username = 'Profesor';
        $user->email = 'profesor@example.com';
        $user->cuenta = '20182404130901';
        $user->password = bcrypt('secret');
        $user->idemp = $idemp;
        $user->ip = $ip;
        $user->host = $host;
        $user->save();
        $user->roles()->attach($role_profesor);
        $user->permissions()->attach($P6);
        $F->validImage($user,'profile','profile/');

        $user = new User();
        $user->ap_paterno = 'Alumno';
        $user->username = 'Alumno';
        $user->email = 'alumno@example.com';
        $user->cuenta = '20182404130937';
        $user->password = bcrypt('secret');
        $user->idemp = $idemp;
        $user->ip = $ip;
        $user->host = $host;
        $user->save();
        $user->roles()->attach($role_alumno);
        $user->permissions()->attach($P6);
        $F->validImage($user,'profile','profile/');

    }
}
