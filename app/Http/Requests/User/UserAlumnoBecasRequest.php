<?php

namespace App\Http\Requests\User;

use App\Models\User\UserBecas;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserAlumnoBecasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'beca_sep'  => ['min:0','max:100','numeric'],
            'beca_arji' => ['min:0','max:100','numeric'],
            'beca_bach' => ['min:0','max:100','numeric'],
            'beca_spf'  => ['min:0','max:100','numeric'],
        ];
    }

    public function updateBecas()
    {

        $becas = [
            'beca_sep'      => $this->beca_sep,
            'beca_arji'     => $this->beca_arji,
            'beca_spf'      => $this->beca_spf,
            'beca_bach'     => $this->beca_bach,
            'observaciones' => strtoupper($this->observaciones),
            'user_id'       => $this->user_id,
        ];

        if ($this->id == 0) {
            $user_becas = UserBecas::create($becas);

        } else {
            $user_becas = UserBecas::find($this->id);
            $user_becas->update($becas);
        }
        return $user_becas;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->response(
            $this->formatErrors($validator)
        ));
    }
    protected function formatErrors(Validator $validator)
    {
        return $validator->errors()->getMessages();
    }

    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);

    }


}
