<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer este request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação.
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ];
    }

    /**
     * Mensagens personalizadas de erro.
     */
    public function messages()
    {
        return [
            'name.required'     => 'O campo nome é obrigatório.',
            'name.string'       => 'O nome deve ser uma string.',
            'name.max'          => 'O nome não pode ter mais que 255 caracteres.',

            'email.required'    => 'O campo e-mail é obrigatório.',
            'email.email'       => 'Informe um e-mail válido.',
            'email.unique'      => 'Este e-mail já está em uso.',

            'password.required' => 'A senha é obrigatória.',
            'password.min'      => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }

    /**
     * Força o retorno da resposta como JSON.
     */
    public function expectsJson()
    {
        return true;
    }
}