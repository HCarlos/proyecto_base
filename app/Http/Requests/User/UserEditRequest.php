<?php

namespace App\Http\Requests\User;

use App\Http\Controllers\Funciones\FuncionesController;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $redirectTo = 'edit';

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
            'fecha_nacimiento' => ['required','date'],
        ];
    }

    public function messages()
    {
        return [
            'fecha_nacimiento.required' => 'Se requiere la fecha de nacimiento',
        ];
    }

    public function updateUser(){
        $user = Auth::user();
        $user->fill([
            'ap_paterno'       => $this->ap_paterno,
            'ap_materno'       => $this->ap_materno,
            'nombre'           => $this->nombre,
            'curp'             => $this->curp,
            'rfc'              => $this->rfc,
            'razon_social'     => $this->razon_social,
            'calle'            => $this->calle,
            'num_ext'          => $this->num_ext,
            'num_int'          => $this->num_int,
            'colonia'          => $this->colonia,
            'localidad'        => $this->localidad,
            'estado'           => $this->estado,
            'pais'             => $this->pais,
            'cp'               => $this->cp,
            'email1'           => $this->email1,
            'email2'           => $this->email2,
            'cel1'             => $this->cel1,
            'cel2'             => $this->cel2,
            'tel1'             => $this->tel1,
            'tel2'             => $this->tel2,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'lugar_nacimiento' => $this->lugar_nacimiento,
            'genero'           => $this->genero,
            'ocupacion'        => $this->ocupacion,
            'iduser_ps'        => $this->iduser_ps,
        ])->save();
        $F = new FuncionesController();
        $F->validImage($user,'profile','profile/');

    }

}
