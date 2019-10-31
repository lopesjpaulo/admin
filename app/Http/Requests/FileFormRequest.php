<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileFormRequest extends FormRequest
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
            'title' => 'required|max:255',
            'categoria_id' => 'required',
            'published_at' => 'required',
            'organizacao_id' => 'required',
            'catorganizacao_id' => 'required',
            'tags' => 'required',
            'file' => 'required|mimes:pdf|max:8192'
        ];
    }
}
