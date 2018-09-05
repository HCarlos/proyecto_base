<?php

namespace App;

use App\Http\Controllers\Funciones\FuncionesController;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
//use Silber\Bouncer\Database\HasRolesAndAbilities;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MyResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
//    use HasRolesAndAbilities;
    use HasRoles;

    protected $guard_name = 'web'; // or whatever guard you want to use
    protected $table = 'users';

    protected $fillable = [
        'id',
        'username', 'email', 'password','cuenta',
        'admin','alumno','foraneo','exalumno','credito',
        'dias_credito','limite_credito','saldo_a_favor','saldo_en_contra',
        'rfc','curp','razon_social','calle','num_ext','num_int',
        'colonia','localidad','estado','pais','cp','email1','email2',
        'cel1','cel2','tel1','tel2','lugar_nacimiento','fecha_nacimiento','genero',
        'ocupacion','lugar_trabajo',
        'root','filename','familia_cliente_id',
        'idemp','ip','host',
        'nombre','ap_paterno','ap_materno','celular','telefono',
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

//    public function empresas(){
//        return $this->hasMany(Empresa::class);
//    }
//    public function empresa(){
//        return $this->belongsTo(Empresa::class);
//    }


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

    public function scopeMyID(){
        return $this->id;
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
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('cuenta', 'like', "%{$search}%");
//            ->orWhereHas('team', function ($query) use ($search) {
//                $query->where('name', 'like', "%{$search}%");
//            });
    }

    public static function findOrCreateUserWithRole3(
        string $cuenta, string $username, string $nombre, string $ap_paterno, string $ap_materno, string $email, string $password,
        bool $admin, bool $alumno, bool $foraneo, bool $exalumno, bool $credito, int $dias_credito, float $limite_credito,
        string $domicilio, string $celular, string $telefono,
        float $saldo_a_favor, float $saldo_en_contra, int $familia_cliente_id,
        int $iduser_ps, int $idemp, Role $role1, Role $role2, Role $role3,
        string $calle='', string $num_ext='', string $num_int='', string $colonia='', string $localidad='', string $estado='', string $pais='', string $cp='', string $curp='', string $rfc='', string $razon_social='',
        string $lugar_nacimiento='', Date $fecha_nacimiento=null, int $genero=null,
        string $ocupacion=''){
        $user = static::all()->where('username', $username)->where('email', $email)->where('cuenta', $cuenta)->first();
        if (!$user) {
            if ($cuenta == ''){
                $timex  = Carbon::now()->format('ymdHisu');
                $cuenta =  substr($timex,0,16);
            }
            if ($email == ''){
                $email = $username.'@example.com';
            }
            if ($password == ''){
                $password = $username;
            }

            $user = static::create([
                'cuenta' => $cuenta,
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
                'celular' => $celular,
                'telefono' => $telefono,
                'admin' => $admin,
                'alumno' => $alumno,
                'foraneo' => $foraneo,
                'exalumno' => $exalumno,
                'credito' => $credito,
                'dias_credito' => $dias_credito,
                'limite_credito' => $limite_credito,
                'saldo_a_favor' => $saldo_a_favor,
                'saldo_en_contra' => $saldo_en_contra,
                'iduser_ps' => $iduser_ps,
                'familia_cliente_id' => $familia_cliente_id,
                'idemp' => $idemp,
            ]);
            $user->roles()->attach($role1);
            $user->roles()->attach($role2);
            $user->roles()->attach($role3);
            $F = new FuncionesController();
            $F->validImage($user,'profile','profile/');

        }
        return $user;

    }


}

