<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 10/10/18
 * Time: 12:14 PM
 */

namespace App\Filters\User;


class UserFilter extends QueryFilter{
    public function rules(): array{
        return [
            'search' => 'filled',
            'roles' => '',
        ];
    }

//    public function filterBySearch($query, $search){
    public function search($query, $search){
        if (is_null($search) ) {
            return $query;
        }

        if (empty ($search)) {
            return $query;
        }
        $search = strtoupper($search);
        return $query
            ->whereRaw("CONCAT(ap_paterno,' ',ap_materno,' ',nombre) like ?", "%{$search}%")
            ->orWhereRaw("UPPER(username) like ?", "%{$search}%")
            ->orWhereHas('roles', function ($q) use ($search) {
                $q->whereRaw("UPPER(name) like ?", "%{$search}%");
            })
            ->orWhere('id', 'like',"%{$search}%");
    }


//    public function filterByRoles($query, $roles){
    public function roles($query, $roles){
        if (is_null($roles) ) {
            return $query;
        }

        if (empty ($roles)) {
            $roles = [];
        }

        return $query
            ->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('role_id', $roles);
            });
    }

}