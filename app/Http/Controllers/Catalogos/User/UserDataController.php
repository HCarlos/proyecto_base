<?php

namespace App\Http\Controllers\Catalogos\User;

use App\Http\Requests\User\UserEditRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdatePasswordRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserDataController extends Controller
{


    protected function showListUser(){
        ini_set('max_execution_time', 300);
        $this->tableName = 'usuarios';
        $items = User::query()
            ->filtrar(request('search'))
            ->orderByDesc('created_at')
            ->paginate();

        $items->appends(request(['search']))->fragment('table');
        //$items->links();

        $user = Auth::User();

        return view ('catalogos.user.user_list',
            [
                'items' => $items,
                'titulo_catalogo' => "Catálogo de ".ucwords($this->tableName),
                'user' => $user,
                'tableName'=>$this->tableName,
            ]
        );
    }

    protected function showEditUserData(){
        $user = Auth::user();
        return view('catalogos.user.user_profile_solo_lectura',
            [
            'items'=>$user,
            'titulo_catalogo' => "Mi Perfil ",
            ]
        );
    }

    protected function update(UserEditRequest $request){
        $request->updateUser();
        return redirect()->route('edit');
    }

    protected function showEditProfilePhoto(){
        $user = Auth::user();
        $titulo_catalogo = "Mi Photo ";
        return view('catalogos.user.user_photo_update',compact("user","titulo_catalogo"));
    }

    protected function showEditProfilePassword(){
        $user = Auth::user();
        $titulo_catalogo = "Mi Password ";
        return view('catalogos.user.user_password_edit',compact("user", "titulo_catalogo"));
    }

    protected function changePasswordUser(UserUpdatePasswordRequest $request){
        $request->updateUserPassword();
        $titulo_catalogo = "Mi Password ";
        return view('catalogos.user.user_password_edit',[
            "user" => Auth::user(),
            "msg"  => 'Password cambiado con éxito!',
            "titulo_catalogo" => $titulo_catalogo,
        ]);
    }

}
