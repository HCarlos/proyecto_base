<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserBecas extends Model
{
    use Notifiable;

    protected $guard_name = 'web'; // or whatever guard you want to use
    protected $table = 'user_becas';

    protected $fillable = [
        'id','user_id',
        'beca_sep','beca_arji','beca_spf', 'beca_bach','observaciones',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

}
