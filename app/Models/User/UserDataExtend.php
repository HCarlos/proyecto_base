<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserDataExtend extends Model
{
    use Notifiable;

    protected $guard_name = 'web'; // or whatever guard you want to use
    protected $table = 'user_extend';

    protected $fillable = [
        'id','user_id',
        'dias_credito','limite_credito','saldo_a_favor','saldo_en_contra',
        'lugar_nacimiento','ocupacion','lugar_trabajo',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

}
