<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 4/10/18
 * Time: 02:51 PM
 */

namespace App\Filters\User;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Styde\Html\Str;

class UserQuery extends Builder
{

    public function findByEmail($email){
        return static::where( 'email' , $email )->first();
    }

    public function filterBy(array $filters){

        $rules = [
          'search' => 'filled',
            'roles' => 'in:Admin,Invitado',
        ];
        $validator = Validator::make($filters,$rules);
//        foreach ($validatos->valid() as $name => $value) {
//            $str = 'filterBy' . Str::Studly($name);
//            if (trim($str) !== "filterByPalabrasRoles") {
//                return $this->{$str}($value);
//            }else{
//                dd($str);
//                return $this->filterByPalabrasRoles($filters['search'],$filters['roles']);
//            }
//        }

          if ($filters['search'] && !$filters['roles']){
              return $this->filterBySearch($filters['search']);
          }
        if (!$filters['search'] && $filters['roles']){
            return $this->filterByRoles($filters['roles']);
        }
        if ($filters['search'] && $filters['roles']){
            return $this->filterByPalabrasRoles($filters['search'],$filters['roles']);
        }

        return $this;
    }

    public function filterBySearch($search)
    {
        if (is_null($search) ) {
            return $this;
        }

        if (empty ($search)) {
            return $this;
        }
        $search = strtoupper($search);
        return $this
            ->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%")
            ->orWhereRaw("UPPER(username) like ?", "%{$search}%")
            ->orWhereHas('roles', function ($q) use ($search) {
                $q->whereRaw("UPPER(name) like ?", "%{$search}%");
            })
            ->orWhere('id', 'like',"%{$search}%");
    }

    public function filterByRoles($roles)
    {
        if (is_null($roles) ) {
            return $this;
        }

        if (empty ($roles)) {
            $roles = [];
        }

        return $this
            ->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('role_id', $roles);
            });
    }


    public function filterByPalabrasRoles($search, $roles)
    {
        if (is_null($search) && is_null($roles)) {
            return $this;
        }
        if (empty ($search)) {
            $search="~";
        }
        if (empty ($roles)) {
            $roles = [];
        }

        $search = strtoupper($search);
        return $this
            ->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%")
            ->orWhereRaw("UPPER(username) like ?", "%{$search}%")
            ->orWhereHas('roles', function ($q) use ($search, $roles) {
                $q->whereRaw("UPPER(name) like ?", "%{$search}%")
                    ->orWhereIn('role_id', $roles);
            })
            ->orWhere('id', 'like',"%{$search}%");

    }

}