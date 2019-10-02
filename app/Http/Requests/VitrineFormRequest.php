<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VitrineFormRequest extends FormRequest
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
            'link' => 'max:255',
            'published_at' => 'required',
            'image' => 'required|image|max:4096'
        ];
    }
}
