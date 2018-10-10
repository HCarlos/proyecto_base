<?php

namespace App;

use App\Filters\User\UserImport;
use App\Filters\User\UserQuery;
use App\Models\User\UserAdress;
use App\Models\User\UserBecas;
use App\Models\User\UserDataExtend;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\MyResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, HasApiTokens, Notifiable;
    use HasRoles;
    use UserImport;

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

    public function newEloquentBuilder($query){
        return new UserQuery($query);
    }

    public function scopeFilterBy($query, $filters){
        return (new UserFilter())->applyTo($query, $filters);
//        return $this->traitFilterBy($filters);
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

    public function user_becas(){
        return $this->hasOne(UserBecas::class);
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

}

