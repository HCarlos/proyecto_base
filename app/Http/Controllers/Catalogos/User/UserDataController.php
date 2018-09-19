<?php

namespace App\Http\Controllers\Catalogos\User;

use App\Http\Requests\User\UserEditRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdatePasswordRequest;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
{
    protected function showEditUserData(){
        $user = Auth::user();
        return view('catalogos.user.user_profile_edit',
            [
            'items'=>$user,
            ]
        );
    }

    protected function update(UserEditRequest $request){
        $request->updateUser();
        return redirect()->route('edit');
    }

    protected function showEditProfilePhoto(){
        $user = Auth::user();
        return view('catalogos.user.user_photo_update',compact("user"));
    }

    protected function showEditProfilePassword(){
        $user = Auth::user();
        return view('catalogos.user.user_password_edit',compact("user"));
    }

    protected function changePasswordUser(UserUpdatePasswordRequest $request){
        $request->updateUserPassword();
        return redirect()->route('home');
    }

}
