<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'ano_publicacao' => 'required|integer|min:1900|max:' . date('Y'),
            'descricao' => 'nullable|string|max:1000',
            'quantidade' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título do livro é obrigatório.',
            'autor.required' => 'O autor do livro é obrigatório.',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório.',
            'quantidade.required' => 'A quantidade de livros é obrigatória.',
            'descricao.max' => 'A descrição não pode exceder 1000 caracteres.',
            'ano_publicacao.min' => 'O ano de publicação deve ser a partir de 1900.',
            'ano_publicacao.max' => 'O ano de publicação não pode ser maior que o ano atual.',
            'quantidade.min' => 'A quantidade deve ser pelo menos 1 livro.',
        ];
    }
}
