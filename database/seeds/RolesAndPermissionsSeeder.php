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
        $role_admin->givePermissionTo($P1);

        $role_sysop = Role::create([
            'name' => 'SysOp',
            'description' => 'System Operator',
            'guard_name' => 'web',
        ]);
        $role_sysop->givePermissionTo($P11);

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
        $F->validImage($user,'profile','profile/');

        Role::findOrCreateRoleMasive('ADMINISTRADOR','Administrador',7);
        Role::findOrCreateRoleMasive('ADMINISTRATIVO','Administrativo',7);
        Role::findOrCreateRoleMasive('ALUMNO','Alumno',7);
        Role::findOrCreateRoleMasive('ASESOR','Asesor',7);
        Role::findOrCreateRoleMasive('CAJERO','Cajero',7);
        Role::findOrCreateRoleMasive('CAPTURISTA','Capturista',7);
        Role::findOrCreateRoleMasive('CE1Ing','Control Escolar 1ro Inglés',7);
        Role::findOrCreateRoleMasive('CEKind','Control Escolar Kinder',7);
        Role::findOrCreateRoleMasive('CEPrep','Control Escolar Preparatoria',7);
        Role::findOrCreateRoleMasive('CEPrim','Control Escolar Primaria',7);
        Role::findOrCreateRoleMasive('CESec','Control Escolar Secundaria',7);
        Role::findOrCreateRoleMasive('COMPRAS','Compras',7);
        Role::findOrCreateRoleMasive('COORDINADOR','Coordinador',7);
        Role::findOrCreateRoleMasive('DIRECTOR','Director',7);
        Role::findOrCreateRoleMasive('EXALUMNO','Exalumno',7);
        Role::findOrCreateRoleMasive('FACTURISTA','Facturista',7);
        Role::findOrCreateRoleMasive('FAMILIAR','Familiar',7);
        Role::findOrCreateRoleMasive('PROFESOR','Profesor',7);
        Role::findOrCreateRoleMasive('PSA','PSA',7);
        Role::findOrCreateRoleMasive('REL_PUB','Relaciones Públicas',7);
        Role::findOrCreateRoleMasive('TUTOR','Tutor',7);


       $x =  User::findOrCreateUserWithRole("per2024","PAULINA","SANSORES","NARAVE","","","CARDENAS","112","","PLAZA VILLAHERMOSA","VILLAHERMOSA","","","86000","","","","","26/11/1971",0,"","","",233,1,"","3|7|14");


    }
}
