<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidarPost extends FormRequest
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
        $id = $this->route('id');
        return [
            'descricao' => 'required',
            'titulo' => 'required|unique:posts,titulo,' . $id . ','
        ];
    }
    public function messages()
    {
        return [
            'titulo.required' => 'Campo obrigatório',
            'titulo.unique' => 'Username já cadastrado para outro usuário',
            'descricao.required' => 'Campo obrigatório',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
