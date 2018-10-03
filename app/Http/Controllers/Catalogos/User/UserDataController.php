<?php

namespace App\Http\Controllers\Catalogos\User;

use App\Http\Requests\User\UserAlumnoBecasRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdatePasswordRequest;
use App\Models\User\UserBecas;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserDataController extends Controller
{

    protected $tableName = "";

    protected function showListUser(Request $request){
        $data = $request->all();
        //dd($data);
        ini_set('max_execution_time', 300);
        $this->tableName = 'usuarios';
        $items = User::query()
            ->with('roles', 'permissions')
            ->filtrar(request('search'))
            ->orderByDesc('id')
            ->paginate();

        $items->appends(request(['search']))->fragment('table');

        $user = Auth::User();
        $roles = Role::all();

        return view ('catalogos.user.user_list',
            [
                'items' => $items,
                'roles' => $roles,
                'checkedRoles' => collect(request('roles')),
                'titulo_catalogo' => "Catálogo de ".ucwords($this->tableName),
                'user' => $user,
                'newWindow' => true,
                'tableName'=>$this->tableName,
                'showEdit'=> 'editUser',
                'newItem'=> 'newUser',
                'removeItem'=> 'removeUser',
                'showEditBecas'=> 'showEditBecas',
            ]
        );
    }

    protected function showEditUserData(){
        $user = Auth::user();
        return view('catalogos.user.user_profile_solo_lectura',
            [
            'user' => $user,
            'items'=>$user,
            'titulo_catalogo' => "",
            ]
        );
    }

    protected function newUser(){
        return view('catalogos.user.user_profile_new',
            [
                'titulo_catalogo' => 'Nuevo',
                'postNew'=> 'createUser',
            ]
        );
    }

    protected function showEditUser($Id){
        $user = User::find($Id);
//        dd($user);
        return view('catalogos.user.user_profile_edit',
            [
                'user' => $user,
                'items'=>$user,
                'titulo_catalogo' => isset($user->Fullname) ? $user->Fullname : 'Nuevo',
                'putEdit'=> 'EditUser',
            ]
        );
    }

    protected function update(UserRequest $request){
        $request->updateUser();
        return redirect()->route('edit');
    }

    protected function updateUser(UserRequest $request){
        $user = $request->manageUser();
        if (!isset($user)){
            abort(404);
        }
        return view('catalogos.user.user_profile_edit',
            [
                'user' => $user,
                'items'=>$user,
                'titulo_catalogo' => $user->Fullname,
                'putEdit'=> 'EditUser',
            ]
        );
    }

    protected function createUser(UserRequest $request){
        $user = $request->manageUser();
        if (!isset($user)){
            abort(404);
        }
        return view('catalogos.user.user_profile_edit',
            [
                'user' => $user,
                'items'=>$user,
                'titulo_catalogo' => $user->Fullname,
                'putEdit'=> 'EditUser',
            ]
        );
    }

    protected function showEditProfilePhoto(){
        $user = Auth::user();
        $titulo_catalogo = "";
        return view('catalogos.user.user_photo_update',[
                "user" => $user,
                "titulo_catalogo" => $titulo_catalogo,
            ]
        );
    }

    protected function showEditProfilePassword(){
        $user = Auth::user();
        $titulo_catalogo = "";
        return view('catalogos.user.user_password_edit',[
                "user" => $user,
                "titulo_catalogo" => $titulo_catalogo,
            ]
        );
    }

    protected function changePasswordUser(UserUpdatePasswordRequest $request){
        $request->updateUserPassword();
        $titulo_catalogo = "";
        return view('catalogos.user.user_password_edit',[
            "user" => Auth::user(),
            "msg"  => 'Password cambiado con éxito!',
            "titulo_catalogo" => $titulo_catalogo,
        ]);
    }

    protected function removeUser($id=0){
        $user = User::withTrashed()->findOrFail($id);
        if (isset($user)){
            if(!$user->trashed()){
                $user->delete();
            }
            else {
                $user->forceDelete();
            }
            return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
        }else{
            return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
        }
    }

    protected function showEditBecas($Id){
        $user = User::find($Id);
        return view ('catalogos.user.user_becas_edit',
            [
                'items' => $user,
            ]
        );
    }

    protected function putAluBecas(UserAlumnoBecasRequest $request){
        $becas = $request->updateBecas();
        if (isset($becas)){
            return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
        }else{
            return Response::json(['mensaje' => 'Error', 'data' => 'Error', 'status' => '422'], 200);
        }

    }




}
