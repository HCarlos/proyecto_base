<?php

namespace App\Http\Requests\User;

use App\Http\Controllers\Funciones\FuncionesController;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $redirectRoute = 'editUser';

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required','min:4','unique:users,username,'.$this->id],
            'email' => ['required','email','unique:users,email,'.$this->id],
            'nombre' => ['required','min:1'],
            'ap_paterno' => ['required','min:1'],
            'curp' => ['required','min:18','max:18'],
            'fecha_nacimiento' => ['required','date'],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'El :attribute requiere por lo menos de 4 caracter',
            'username.unique' => 'El :attribute ya existe',

            'email.required' => 'El :attribute es obligatorio',
            'email.unique' => 'El :attribute ya existe',

            'nombre.min' => 'El :attribute requiere por lo menos de 1 caracter',
            'ap_paterno.min' => 'El :attribute requiere por lo menos de 1 caracter',
            'ap_paterno.required' => 'Se requiere el :attribute',
            'nombre.required' => 'Se requiere el :attribute',

            'curp.min' => 'Para la :attribute se requieren 18 caracteres',
            'curp.max' => 'Para la :attribute se requieren 18 caracteres',
            'curp.required' => 'Se requiere la :attribute',

            'fecha_nacimiento.required' => 'Se requiere la :attribute',
        ];
    }

    public function attributes()
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'nombre' => 'Nombre',
            'ap_paterno' => 'Apellido Paterno',
            'curp' => 'CURP',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
        ];
    }

    public function manageUser()
    {

        $UserN = [
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->username)
        ];

        $User = [
            'ap_paterno'       => strtoupper($this->ap_paterno),
            'ap_materno'       => strtoupper($this->ap_materno),
            'nombre'           => strtoupper($this->nombre),
            'curp'             => strtoupper($this->curp),
            'emails'           => $this->emails,
            'celulares'        => $this->celulares,
            'telefonos'        => $this->telefonos,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'genero'           => $this->genero,
            'iduser_ps'        => $this->iduser_ps,
        ];

        $User_Adress = [
            'calle'     => strtoupper($this->calle),
            'num_ext'   => $this->num_ext,
            'num_int'   => $this->num_int,
            'colonia'   => strtoupper($this->colonia),
            'localidad' => strtoupper($this->localidad),
            'estado'    => strtoupper($this->estado),
            'pais'      => strtoupper($this->pais),
            'cp'        => $this->cp,
        ];

        $User_Data_Extend = [
            'lugar_nacimiento' => strtoupper($this->lugar_nacimiento),
            'ocupacion'        => strtoupper($this->ocupacion),
        ];
//        DB::transaction(function ()
//        use (
//            $UserN, $User, $User_Adress, $User_Data_Extend
//        ) {
            if ($this->id == 0) {
                $user = User::create($UserN);
                $user->update($User);
                $role_invitado = Role::findByName('Invitado');
                $user->roles()->attach($role_invitado);
                $P1 = Permission::findByName('consultar');
                $user->permissions()->attach($P1);
                $user->user_adress()->create();
                $user->user_data_extend()->create();
                $F = new FuncionesController();
                $F->validImage($user, 'profile', 'profile/');

                $user->user_adress()->create($User_Adress);
                $user->user_data_extend()->create($User_Data_Extend);
            } else {
                $user = User::find($this->id);
                $user->update($User);
                $user->user_adress()->update($User_Adress);
                $user->user_data_extend()->update($User_Data_Extend);
            }
//        });
        return $user;
    }

    protected function validPhoto(User $user){
        $F = new FuncionesController();
        $F->validImage($user,'profile','profile/');

    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        if ($this->id > 0){
            return $url->route($this->redirectRoute,['Id'=>$this->id]);
        }else{
            return $url->route('newUser');
        }
    }

}
