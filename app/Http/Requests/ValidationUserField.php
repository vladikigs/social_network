<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ValidationUserField extends FormRequest
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
            //
            'nameBook' => 'required|min:5|max:30',
            'textBook' => 'required|min:5|max:4294967295',
        ];
    }

    public function messages()
    {
        return [
            'nameBook.required' => 'Поле "Название книги" обязательно для заполнения',
            'textBook.required'  => 'Поле "Текст книги" обязательный для заполнения',
            'textBook.min'  => 'Поле "Текст книги" должен быть больше чем 5 символов',
            'nameBook.max'  => 'Поле "Текст книги" не должно быть больше чем 30 символов',
            'nameBook.min'  => 'Поле "Название книги" должен быть больше чем 5 символов',
        ];
    }
}
