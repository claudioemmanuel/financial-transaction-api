<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

            'name' => [
                'required',
                'max:100'
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],

            'cpf_cnpj' => [
                'required',
                'max:18',
                'unique:users,cpf_cnpj'
            ],

            'password' => [
                'required'
            ],

            'user_type_id' => [
                'required',
                'numeric'
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'unique'    => 'O :attribute já está em uso',
            'required'  => 'O :attribute é obrigatório',
            'numeric'   => 'O campo :attribute é do tipo numérico'
        ];
    }
}
