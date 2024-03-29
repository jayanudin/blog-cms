<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:100|min:5',
            'thumbnail' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'required|min:5|max:100',
            'content' => 'required|min:5',
            'highlight' => 'required',
            'status' => 'required',
        ];
    }
}
