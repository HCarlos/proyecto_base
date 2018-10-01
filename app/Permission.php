<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
//use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasRoles;
//    use HasPermissions;
    use SoftDeletes;

    protected $guard_name = 'web'; // or whatever guard you want to use
    protected $table = 'permissions';

    public static function findByName($name){
        return static::where( 'name',$name )->first();
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function users() {
        // Esta en muchos Roles
        return $this->belongsToMany(User::class);
    }

}
