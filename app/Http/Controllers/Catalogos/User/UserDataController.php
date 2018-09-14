<?php

namespace App\Http\Controllers\Catalogos\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
{
    protected function showEditUserData(){
        $user = Auth::user();
        return view('catalogos.user.profile_edit',
            [
            'items'=>$user,
            ]
        );
    }
}
