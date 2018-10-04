<?php

use App\Http\Controllers\Funciones\FuncionesController;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//use App\Permission;
//use App\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()['cache']->forget('spatie.permission.cache');

        $F = new FuncionesController();
        $ip   = 'root_init';//$_SERVER['REMOTE_ADDR'];
        $host = 'root_init';//gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $idemp = 1;

        $P1 = Permission::create(['name' => 'all']);
        $P2 = Permission::create(['name' => 'crear']);
        $P3 = Permission::create(['name' => 'guardar']);
        $P4 = Permission::create(['name' => 'editar']);
        $P5 = Permission::create(['name' => 'modificar']);
        $P6 = Permission::create(['name' => 'eliminar']);
        $P7 = Permission::create(['name' => 'consultar']);
        $P8 = Permission::create(['name' => 'imprimir']);
        $P9 = Permission::create(['name' => 'asignar']);
        $P10 = Permission::create(['name' => 'desasignar']);
        $P11 = Permission::create(['name' => 'sysop']);

        $role_admin = Role::create([
            'name' => 'Administrator',
            'description' => 'Administrator',
            'guard_name' => 'web',
        ]);
        $role_admin->permissions()->attach($P1);

        $role_sysop = Role::create([
            'name' => 'SysOp',
            'description' => 'System Operator',
            'guard_name' => 'web',
        ]);
        $role_sysop->permissions()->attach($P11);

        $role_invitado = Role::create([
            'name' => 'Invitado',
            'description' => 'Invitado',
            'guard_name' => 'web',
        ]);
        $role_invitado->permissions()->attach($P7);

        $user = new User();
        $user->nombre = 'Administrador';
        $user->username = 'Admin';
        $user->email = 'sentauro@gmail.com';
        $user->password = bcrypt('secret');
        $user->genero = 1;
        $user->admin = true;
        $user->empresa_id = $idemp;
        $user->ip = $ip;
        $user->host = $host;
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($role_admin);
        $user->permissions()->attach($P1);
        $user->user_adress()->create();
        $user->user_data_extend()->create();
        $F->validImage($user,'profile','profile/');

        $user = new User();
        $user->nombre = 'System Operator';
        $user->username = 'SysOp';
        $user->email = 'sysop@example.com';
        $user->password = bcrypt('sysop');
        $user->admin = false;
        $user->empresa_id = $idemp;
        $user->ip = $ip;
        $user->host = $host;
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($role_sysop);
        $user->permissions()->attach($P11);
        $user->user_adress()->create();
        $user->user_data_extend()->create();
        $F->validImage($user,'profile','profile/');


        Role::create(['name'=>'ADMINISTRADOR','description'=>'Administrador','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ADMINISTRATIVO','description'=>'Administrativo','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ALUMNO','description'=>'Alumno','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'ASESOR','description'=>'Asesor','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAJERO','description'=>'Cajero','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CAPTURISTA','description'=>'Capturista','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CE1Ing','description'=>'Control Escolar 1ro Inglés','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CEKind','description'=>'Control Escolar Kinder','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CEPrep','description'=>'Control Escolar Preparatoria','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CEPrim','description'=>'Control Escolar Primaria','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'CESec','description'=>'Control Escolar Secundaria','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COMPRAS','description'=>'Compras','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'COORDINADOR','description'=>'Coordinador','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'DIRECTOR','description'=>'Director','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'EXALUMNO','description'=>'Exalumno','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'FACTURISTA','description'=>'Facturista','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'FAMILIAR','description'=>'Familiar','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PROFESOR','description'=>'Profesor','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PSA','description'=>'PSA','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'REL_PUB','description'=>'Relaciones Públicas','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'TUTOR','description'=>'Tutor','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'PREFECTO','description'=>'Prefecto','guard_name'=>'web'])->permissions()->attach($P7);
        Role::create(['name'=>'MODULAR','description'=>'Modular','guard_name'=>'web'])->permissions()->attach($P7);

    }
}
