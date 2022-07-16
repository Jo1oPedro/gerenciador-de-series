<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|string|unique:series,name',
            'cover' => 'sometimes|image|mimes:png,jpg,jpeg,gif'
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'O campo nome é obrigatorio',
            'name.min' => 'O campo nome precisa ter pelo menos :min caracteres',
            'name.string' => 'O campo nome precisa ser um texto',
            'name.unique' => 'A série requisitada já existe',
        ];
    }
}
