<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserAdress extends Model
{
    use Notifiable;

    protected $guard_name = 'web'; // or whatever guard you want to use
    protected $table = 'user_adress';

    protected $fillable = [
        'id','user_id',
        'calle','num_ext','num_int',
        'colonia','localidad','estado','pais','cp',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }


    //
}
