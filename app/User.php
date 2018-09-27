<?php

namespace App;

use App\Http\Controllers\Funciones\FuncionesController;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use PhpOffice\PhpSpreadsheet\Shared\Date;
//use Silber\Bouncer\Database\HasRolesAndAbilities;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MyResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
//use \Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, HasApiTokens, Notifiable, HasRoles;

    protected $guard_name = 'web'; // or whatever guard you want to use
    protected $table = 'users';

    protected $fillable = [
        'id',
        'username', 'email', 'password',
        'nombre','ap_paterno','ap_materno',
        'admin','alumno','foraneo','exalumno','credito',
        'dias_credito','limite_credito','saldo_a_favor','saldo_en_contra',
        'rfc','curp','razon_social','calle','num_ext','num_int',
        'colonia','localidad','estado','pais','cp','emails','celulares','telefonos',
        'lugar_nacimiento','fecha_nacimiento','genero', 'ocupacion','lugar_trabajo',
        'root','filename','filename_png','filename_thumb',
        'empresa_id','iduser_ps','status_user','ip','host',

    ];

    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['admin'=>'boolean','alumno'=>'boolean','foraneo'=>'boolean','exalumno'=>'boolean','credito'=>'boolean',];

    public static function findByEmail($email){
        return static::where( compac('email') )->first();
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin(){
        return $this->admin;
    }

    public function isAlumno(){
        return $this->alumno;
    }

    public function isForaneo(){
        return $this->foraneo;
    }

    public function isExalumno(){
        return $this->exalumno;
    }

    public function isCredito(){
        return $this->credito;
    }

    public function IsEmptyPhoto(){
        return $this->filename == '' ? true : false;
    }

    public function IsFemale(){
        return $this->genero == 0 ? true : false;
    }

    public function scopeMyID(){
        return $this->id;
    }

    public function scopeRole(){
        return $this->roles()->first();
    }

    public function getFullNameAttribute() {
        return "{$this->ap_paterno} {$this->ap_materno} {$this->nombre}";
    }

    public function sendPasswordResetNotification($token){
        $this->notify(new MyResetPassword($token));
    }

    public function scopeFiltrar($query, $search)
    {
        if (empty ($search)) {
            return;
        }
        $search = strtoupper($search);
        $query->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%");
//            ->orWhereHas('team', function ($query) use ($search) {
//                $query->where('name', 'like', "%{$search}%");
//            });
    }

    public static function findOrCreateUserWithRole(
        string $username, string $nombre, string $ap_paterno, string $ap_materno, string $email, string $password,
        string $calle='', string $num_ext='', string $num_int='', string $colonia='', string $localidad='',
        string $estado='TABASCO', string $pais='MÉXICO', string $cp='', string $curp='', string $rfc='',
        string $razon_social='', string $lugar_nacimiento='', string $fecha_nacimiento, int $genero=0, string $emails, string $celulares, string $telefonos, int $iduser_ps, int $empresa_id, string $ocupacion='', string $roles
        ){
        $result = false;
        $user = static::where('username', $username)->where('email', $email)->first();
        if (!$user) {
            if ($email == ''){
                $email = $username.'@example.com';
            }
            if ($password == ''){
                $password = $username;
            }

            $fecha_nacimiento =  DateTime::createFromFormat('d/m/Y', $fecha_nacimiento)->format('Y-m-d');

            $user = static::create([
                'username'=>$username,
                'nombre'=>$nombre,
                'ap_paterno'=>$ap_paterno,
                'ap_materno'=>$ap_materno,
                'email'=>$email,
                'password' => bcrypt($password),
                'rfc' => $rfc,
                'curp' => $curp,
                'razon_social' => $razon_social,
                'calle' => $calle,
                'num_ext' => $num_ext,
                'num_int' => $num_int,
                'colonia' => $colonia,
                'localidad' => $localidad,
                'estado' => $estado,
                'pais' => $pais,
                'cp' => $cp,
                'lugar_nacimiento' => $lugar_nacimiento,
                'fecha_nacimiento' => $fecha_nacimiento,
                'genero' => $genero,
                'ocupacion'=> $ocupacion,
                'emails' => $emails,
                'celulares' => $celulares,
                'telefonos' => $telefonos,
                'iduser_ps' => $iduser_ps,
                'empresa_id' => $empresa_id,
            ]);
            $roless = explode('|',$roles);
            foreach ($roless as $role){
                $user->roles()->attach($role);
            }
            $user->permissions()->attach(7);
            $result = $user ?? true;

            $F = new FuncionesController();
            $F->validImage($user,'profile','profile/');

        }
        return $result;

    }


}

