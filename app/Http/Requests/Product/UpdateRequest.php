<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => 'required|min:10',
            'article' => ['required',
                'alpha_dash:ascii',
                Rule::unique('products', 'article')->ignore($this->id)
            ],
            'status' => '',
            'data' => ''
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Это поле обязательное',
            'name.min' => 'Длина не может быть меньше 10 символов',
            'article.required' => 'Это поле обязательное',
            'article.alpha_dash' => 'Можно использовать только латинские символы и цифры',
            'article.unique' => 'Такое значение уже есть',
        ];
    }
}
