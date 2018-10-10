<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 4/10/18
 * Time: 02:51 PM
 */

namespace App\Filters\User;


use App\Traits\User\FiltersQuerys;
use Illuminate\Database\Eloquent\Builder;

class UserQuery extends Builder
{
//    use FiltersQuerys {
//        filterBy as traitFilterBy;
//    }

    public function filterBy(array $filters){
        return (new UserFilter())->applyTo($this, $filters);
//        return $this->traitFilterBy($filters);
    }

    public function findByEmail($email){
        return $this->where( 'email' , $email )->first();
    }

    public function filterRules(): array{
        return [
//            'search' => 'filled',
//            'roles' => '',
        ];
    }


}