<?php

namespace App\Http\Requests;

use App\Rules\IsCommonUser;
use Illuminate\Foundation\Http\FormRequest;

class UserTransactionRequest extends FormRequest
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

            'user' => [
                'required',
                new IsCommonUser(),
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
            'required' => 'O :attribute é obrigatório',
        ];
    }
}
