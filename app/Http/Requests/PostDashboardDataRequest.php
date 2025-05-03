<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostDashboardDataRequest extends FormRequest
{
    public function authorize()
    {
        // Aqui você pode verificar se o usuário tem permissão para fazer essa requisição
        return true;
    }

    public function rules()
    {
        return [
            'amount'      => 'required|numeric',
            'date'        => 'required|date',
            'category_id' => 'required|exists:categories,id', // Valida se a categoria existe
            'description' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'amount.required'      => 'O campo valor é obrigatório.',
            'amount.numeric'       => 'O campo valor precisa ser um número.',
            'date.required'        => 'A data é obrigatória.',
            'date.date'            => 'A data fornecida não é válida.',
            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists'   => 'A categoria selecionada não existe.',
            'description.string'   => 'A descrição precisa ser uma string válida.',
        ];
    }
}