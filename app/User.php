<?php

namespace App;

use App\Http\Controllers\Funciones\FuncionesController;
use App\Models\User\UserAdress;
use App\Models\User\UserDataExtend;
use DateTime;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MyResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, HasApiTokens, Notifiable, HasRoles;

    protected $guard_name = 'web';
    protected $table = 'users';

    protected $fillable = [
        'id',
        'username', 'email', 'password',
        'nombre','ap_paterno','ap_materno',
        'admin','alumno','foraneo','exalumno','credito',
        'curp','emails','celulares','telefonos',
        'fecha_nacimiento','genero',
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

    public function user_adress(){
        return $this->hasOne(UserAdress::class);
    }

    public function user_data_extend(){
        return $this->hasOne(UserDataExtend::class);
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
        string $cp='', string $curp='', string $lugar_nacimiento='', string $fecha_nacimiento, int $genero=0,
        string $emails, string $celulares, string $telefonos, int $iduser_ps, int $empresa_id, string $ocupacion='',
        string $roles
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
            DB::transaction(function ()
            use
            (
                $username, $nombre, $ap_paterno, $ap_materno, $email, $password, $curp,
                $calle, $num_ext, $num_int, $colonia, $localidad, $cp,
                $lugar_nacimiento, $fecha_nacimiento, $genero, $emails, $celulares, $telefonos,
                $iduser_ps, $empresa_id, $ocupacion, $roles
            )
            {
                $user = static::create([
                    'username'=>$username,
                    'nombre'=>$nombre,
                    'ap_paterno'=>$ap_paterno,
                    'ap_materno'=>$ap_materno,
                    'email'=>$email,
                    'password' => bcrypt($password),
                    'curp' => $curp,
                    'fecha_nacimiento' => $fecha_nacimiento,
                    'genero' => $genero,
                    'emails' => $emails,
                    'celulares' => $celulares,
                    'telefonos' => $telefonos,
                    'iduser_ps' => $iduser_ps,
                    'empresa_id' => $empresa_id,
                ]);
                $user->user_adress()->create([
                    'calle' => $calle,
                    'num_ext' => $num_ext,
                    'num_int' => $num_int,
                    'colonia' => $colonia,
                    'localidad' => $localidad,
                    'cp' => $cp,
                ]);
                $user->user_data_extend()->create([
                    'ocupacion'=> $ocupacion,
                    'lugar_nacimiento' => $lugar_nacimiento,
                ]);

                $roless = explode('|',$roles);
                foreach ($roless as $role){
                    $user->roles()->attach($role);
                }
                $user->permissions()->attach(7);
                $result = $user ?? true;

                $F = new FuncionesController();
                $F->validImage($user,'profile','profile/');

            });

        }

        return $result;

    }


}

