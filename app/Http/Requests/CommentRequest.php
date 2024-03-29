<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'email' => 'required|min:5|max:50',
            'full_name' => 'required|min:5|max:50',
            'content' => 'required|min:5|max:255',
            'status' => 'required',
            'article_id' => 'required',
        ];
    }
}
