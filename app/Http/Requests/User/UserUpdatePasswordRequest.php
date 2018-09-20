<?php

namespace App\Http\Requests\User;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $redirectRoute = "showEditProfilePassword/";

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
            'password_actual' => 'required|min:6|current_password',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
    {

        return [
            'password_actual.required' => 'Se requiere el :attribute.',
            'password_actual.min' => 'El :attribute debe ser por lo menos de 6 caracteres.',
            'password_actual.current_password' => 'El :attribute no es correcto.',
            'password.required' => 'Se requiere el :attribute.',
            'password.min' => ':attribute debe ser por lo menos de 6 caracteres.',
            'password_confirmation.required' => 'Se requiere confirmar el :attribute.',
            'password.same' => 'La confirmación del :attribute no coincide con el nuevo password.',
        ];
    }

    public function attributes()
    {
        return [
            'password_actual' => 'Password Actual',
            'password' => 'Password',
            'password_confirmation' => 'Confirmar Password',
        ];
    }

    /**
     * Get the sanitized input for the request.
     *
     * @return array
     */
    public function sanitize()
    {
        return $this->only('password');
    }


    public function updateUserPassword(){
        try {
            $user = Auth::user();
            $user->password  = bcrypt($this->password);
            $user->save();
            auth()->login($user);
        } catch (Exception $exception) {
            logger()->error($exception);
            return "Whoops! algo salió mal.";
        }
        return redirect()->route('home');

    }

}
